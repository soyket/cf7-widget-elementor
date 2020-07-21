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
// menu hide wp admin menu function after onload iframe contants
function voidCf7IframeOnLoad() {

  // select iframe
  var iframe = document.getElementsByClassName("cf7-widget-elementor-modal-iframe");

  // check iframe found
  if(iframe != null && iframe.length > 0){
    // select wpadminbar, wpcontent, wpadmibar, wp-toolbar for modify it
    var adminBar = iframe[0].contentWindow.document.getElementById("wpadminbar");
    var wpToolBar = iframe[0].contentWindow.document.getElementsByClassName("wp-toolbar");
    var adminMenu = iframe[0].contentWindow.document.getElementById("adminmenumain");
    var wpContent = iframe[0].contentWindow.document.getElementById("wpcontent");

    // wp admin bar hide
    if(adminBar != null){
      adminBar.style.display = "none";
    }

    // wp toolbar padding top remove
    if(wpToolBar !=null && wpToolBar.length > 0){
      wpToolBar[0].style.paddingTop = '0px';
    }

    // wp admin menu hide
    if(adminMenu != null){
      adminMenu.style.display = "none";
    }

    // wp content margin left hide
    if(wpContent != null){
      wpContent.style.marginLeft = "0px";
    }

    // set opacity 1 to show iframe after hiding all the wp bars
    iframe[0].style.opacity = 1;
    
  }

}

</script>