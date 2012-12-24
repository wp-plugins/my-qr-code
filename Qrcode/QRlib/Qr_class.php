<?php
    define('QR_CACHEABLE', false);
    define('QR_CACHE_DIR', dirname(__FILE__).DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR);
    define('QR_LOG_DIR', dirname(__FILE__).DIRECTORY_SEPARATOR);

    define('QR_FIND_BEST_MASK', true);
    define('QR_FIND_FROM_RANDOM', false);
    define('QR_DEFAULT_MASK', 2);

        define('QR_MODE_NUL', -1);
	define('QR_MODE_NUM', 0);
	define('QR_MODE_AN', 1);
	define('QR_MODE_8', 2);
	define('QR_MODE_KANJI', 3);
	define('QR_MODE_STRUCTURE', 4);

	// Levels of error correction.

	define('QR_ECLEVEL_L', 0);
	define('QR_ECLEVEL_M', 1);
	define('QR_ECLEVEL_Q', 2);
	define('QR_ECLEVEL_H', 3);

    define('QR_PNG_MAXIMUM_SIZE',  1024);

    class qrstr {
		public static function set(&$srctab, $x, $y, $repl, $replLen = false) {
			$srctab[$y] = substr_replace($srctab[$y], ($replLen !== false)?substr($repl,0,$replLen):$repl, $x, ($replLen !== false)?$replLen:strlen($repl));
		}
	}
    class QRbar_image {
        
        public static function png($frame, $filename = false, $pixelPerPoint = 4, $outerFrame = 4,$saveandprint=FALSE)
        {
            $image = self::image($frame, $pixelPerPoint, $outerFrame);

            if ($filename === false) {
                Header("Content-type: image/png");
                ImagePng($image);
            } else {
                if($saveandprint===TRUE){
                    ImagePng($image, $filename);
                    header("Content-type: image/png");
                    ImagePng($image);
                }else{
                    ImagePng($image, $filename);
                }
            }

            ImageDestroy($image);
        }

        
        public static function jpg($frame, $filename = false, $pixelPerPoint = 8, $outerFrame = 4, $q = 85)
        {
            $image = self::image($frame, $pixelPerPoint, $outerFrame);

            if ($filename === false) {
                Header("Content-type: image/jpeg");
                ImageJpeg($image, null, $q);
            } else {
                ImageJpeg($image, $filename, $q);
            }

            ImageDestroy($image);
        }

        
        private static function image($frame, $pixelPerPoint = 4, $outerFrame = 4)
        {
            $h = count($frame);
            $w = strlen($frame[0]);

            $imgW = $w + 2*$outerFrame;
            $imgH = $h + 2*$outerFrame;

            $base_image =ImageCreate($imgW, $imgH);

            $col[0] = ImageColorAllocate($base_image,255,255,255);
            $col[1] = ImageColorAllocate($base_image,0,0,0);

            imagefill($base_image, 0, 0, $col[0]);

            for($y=0; $y<$h; $y++) {
                for($x=0; $x<$w; $x++) {
                    if ($frame[$y][$x] == '1') {
                        ImageSetPixel($base_image,$x+$outerFrame,$y+$outerFrame,$col[1]);
                    }
                }
            }

            $target_image =ImageCreate($imgW * $pixelPerPoint, $imgH * $pixelPerPoint);
            ImageCopyResized($target_image, $base_image, 0, 0, 0, 0, $imgW * $pixelPerPoint, $imgH * $pixelPerPoint, $imgW, $imgH);
            ImageDestroy($base_image);

            return $target_image;
        }
    }
    //class QRtools {
    class QRbar_tools {
        public static function binarize($frame)
        {
            $len = count($frame);
            foreach ($frame as &$frameLine) {

                for($i=0; $i<$len; $i++) {
                    $frameLine[$i] = (ord($frameLine[$i])&1)?'1':'0';
                }
            }

            return $frame;
        }
        public static function log($outfile, $err)
        {
            if (QR_LOG_DIR !== false) {
                if ($err != '') {
                    if ($outfile !== false) {
                        file_put_contents(QR_LOG_DIR.basename($outfile).'-errors.txt', date('Y-m-d H:i:s').': '.$err, FILE_APPEND);
                    } else {
                        file_put_contents(QR_LOG_DIR.'errors.txt', date('Y-m-d H:i:s').': '.$err, FILE_APPEND);
                    }
                }
            }
        }
        public static function markTime($markerId)
        {
            list($usec, $sec) = explode(" ", microtime());
            $time = ((float)$usec + (float)$sec);

            if (!isset($GLOBALS['qr_time_bench']))
                $GLOBALS['qr_time_bench'] = array();

            $GLOBALS['qr_time_bench'][$markerId] = $time;
        }
    }
    QRbar_tools::markTime('start');

    class QR_wpbit {
    //class QRbitstream {

        public $data = array();

        //----------------------------------------------------------------------
        public function size()
        {
            return count($this->data);
        }

        //----------------------------------------------------------------------
        public function allocate($setLength)
        {
            $this->data = array_fill(0, $setLength, 0);
            return 0;
        }

        //----------------------------------------------------------------------
        public static function newFromNum($bits, $num)
        {
            $bstream = new QR_wpbit();
            $bstream->allocate($bits);

            $mask = 1 << ($bits - 1);
            for($i=0; $i<$bits; $i++) {
                if($num & $mask) {
                    $bstream->data[$i] = 1;
                } else {
                    $bstream->data[$i] = 0;
                }
                $mask = $mask >> 1;
            }

            return $bstream;
        }

        //----------------------------------------------------------------------
        public static function newFromBytes($size, $data)
        {
            $bstream = new QR_wpbit();
            $bstream->allocate($size * 8);
            $p=0;

            for($i=0; $i<$size; $i++) {
                $mask = 0x80;
                for($j=0; $j<8; $j++) {
                    if($data[$i] & $mask) {
                        $bstream->data[$p] = 1;
                    } else {
                        $bstream->data[$p] = 0;
                    }
                    $p++;
                    $mask = $mask >> 1;
                }
            }

            return $bstream;
        }

        //----------------------------------------------------------------------
        public function append(QR_wpbit $arg)
        {
            if (is_null($arg)) {
                return -1;
            }

            if($arg->size() == 0) {
                return 0;
            }

            if($this->size() == 0) {
                $this->data = $arg->data;
                return 0;
            }

            $this->data = array_values(array_merge($this->data, $arg->data));

            return 0;
        }

        //----------------------------------------------------------------------
        public function appendNum($bits, $num)
        {
            if ($bits == 0)
                return 0;

            $b = QR_wpbit::newFromNum($bits, $num);

            if(is_null($b))
                return -1;

            $ret = $this->append($b);
            unset($b);

            return $ret;
        }

        //----------------------------------------------------------------------
        public function appendBytes($size, $data)
        {
            if ($size == 0)
                return 0;

            $b = QR_wpbit::newFromBytes($size, $data);

            if(is_null($b))
                return -1;

            $ret = $this->append($b);
            unset($b);

            return $ret;
        }

        //----------------------------------------------------------------------
        public function toByte()
        {

            $size = $this->size();

            if($size == 0) {
                return array();
            }

            $data = array_fill(0, (int)(($size + 7) / 8), 0);
            $bytes = (int)($size / 8);

            $p = 0;

            for($i=0; $i<$bytes; $i++) {
                $v = 0;
                for($j=0; $j<8; $j++) {
                    $v = $v << 1;
                    $v |= $this->data[$p];
                    $p++;
                }
                $data[$i] = $v;
            }

            if($size & 7) {
                $v = 0;
                for($j=0; $j<($size & 7); $j++) {
                    $v = $v << 1;
                    $v |= $this->data[$p];
                    $p++;
                }
                $data[$bytes] = $v;
            }

            return $data;
        }

    }
?>
