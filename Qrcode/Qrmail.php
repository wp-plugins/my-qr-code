<div class="wrap metabox-holder has-right-sidebar">
    <h2>QR Plugin</h2>
    <div class="postbox">
        <h3><span>Get Confirmation Key</span></h3>
        <div class="inside" id="mailinside">
            <p><?php echo $Form_code ;?></p>
        </div>
    </div>
    <div class=updated below-h2>
          <h3>Installation</h3>
          <p><font color="red"><?php echo $message; ?></font></p>
          <p>Please enter your Confirmation Key</p>
          <form id="vi_install" method="post" name="vi_install">
                   <strong>Confirmation Key:</strong>
                   <input type=text name=vi_install_Key  size=40 >
                   <input type=submit value=Install name=vi_submit class=button-primary><br/><br/>
          </form>
    </div>
</div>