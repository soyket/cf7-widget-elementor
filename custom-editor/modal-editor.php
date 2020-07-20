<!-- The Modal -->
<div id="cf7_widget_elementor_contact_form_control_modal" class="cf7_widget_elementor_contact_form_control_modal" style="display: none;">

  <!-- Modal content -->
  <div class="cf7-widget-elementor-modal-content">
    <span class="cf7-widget-elementor-modal-close">&times;</span>
    <!-- iframe to open contact form edit or add functionality -->
    <iframe onload="voidCf7IframeOnLoad()" class="cf7-widget-elementor-modal-iframe" ></iframe>
    <button class="cf7-widget-elementor-modal-hide-adminmenu" onclick="voidCf7AdminMenuHide()">Try it</button>
  </div>
</div>

<script>
function voidCf7AdminMenuHide() {
  var iframe = document.getElementsByClassName("cf7-widget-elementor-modal-iframe");
  var adminMenu = iframe[0].contentWindow.document.getElementById("adminmenumain");
  var wpContent = iframe[0].contentWindow.document.getElementById("wpcontent");
  if(adminMenu != null){
    adminMenu.style.display = "none";
  }
  if(wpContent != null){
    wpContent.style.marginLeft = "0px";
  }
}

function voidCf7IframeOnLoad(){
  voidCf7AdminMenuHide();
}
</script>