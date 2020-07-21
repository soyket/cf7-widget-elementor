<!-- The Modal -->
<div id="cf7_widget_elementor_contact_form_control_modal" class="cf7_widget_elementor_contact_form_control_modal" style="display: none;">

  <!-- Modal content -->
  <div class="cf7-widget-elementor-modal-content">
    <span class="cf7-widget-elementor-modal-close">&times;</span>
    <!-- iframe to open contact form edit or add functionality -->
    <iframe onload="voidCf7IframeOnLoad()" class="cf7-widget-elementor-modal-iframe" ></iframe>
  </div>
</div>

<script>
// mneu hide wp admin menu function
function voidCf7AdminMenuHide() {
  var iframe = document.getElementsByClassName("cf7-widget-elementor-modal-iframe");
  var adminMenu = iframe[0].contentWindow.document.getElementById("adminmenumain");
  var wpContent = iframe[0].contentWindow.document.getElementById("wpcontent");
  var adminBar = iframe[0].contentWindow.document.getElementById("wpadminbar");
  if(adminMenu != null){
    adminMenu.style.display = "none";
  }
  if(adminBar != null){
    adminBar.style.display = "none";
  }
  if(wpContent != null){
    wpContent.style.marginLeft = "0px";
  }
}
// iframe onload function
function voidCf7IframeOnLoad(){
  // call hide admin menu function after load iframe
  voidCf7AdminMenuHide();
}
</script>