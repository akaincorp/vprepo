var cbVideoDisable;
var cbAVPFDisable;
var txtWebsocketServerUrl;
var txtSIPOutboundProxyUrl;
var txtInfo;



function settingsSave() {
  window.localStorage.setItem('org.doubango.expert.disable_video', cbVideoDisable.checked ? "true" : "false");
  window.localStorage.setItem('org.doubango.expert.enable_rtcweb_breaker', cbRTCWebBreaker.checked ? "true" : "false");
  if (!txtWebsocketServerUrl.disabled) {
    window.localStorage.setItem('org.doubango.expert.websocket_server_url', txtWebsocketServerUrl.value);
  }
  window.localStorage.setItem('org.doubango.expert.sip_outboundproxy_url', txtSIPOutboundProxyUrl.value);
  window.localStorage.setItem('org.doubango.expert.ice_servers', txtIceServers.value);
  window.localStorage.setItem('org.doubango.expert.bandwidth', txtBandwidth.value);
  window.localStorage.setItem('org.doubango.expert.video_size', txtSizeVideo.value);
  window.localStorage.setItem('org.doubango.expert.disable_early_ims', cbEarlyIMS.checked ? "true" : "false");
  window.localStorage.setItem('org.doubango.expert.disable_debug', cbDebugMessages.checked ? "true" : "false");
  window.localStorage.setItem('org.doubango.expert.enable_media_caching', cbCacheMediaStream.checked ? "true" : "false");
  window.localStorage.setItem('org.doubango.expert.disable_callbtn_options', cbCallButtonOptions.checked ? "true" : "false");

  txtInfo.innerHTML = '<i>Saved</i>';
}

document.getElementById('cbVideoDisable').checked = true;
document.getElementById('cbEarlyIMS').checked = true;
document.getElementById('cbCacheMediaStream').checked = true;

function settingsRevert(bNotUserAction) {
  cbRTCWebBreaker.checked = (window.localStorage.getItem('org.doubango.expert.enable_rtcweb_breaker') == "true");
  txtSIPOutboundProxyUrl.value = (window.localStorage.getItem('org.doubango.expert.sip_outboundproxy_url') || "");
  txtBandwidth.value = (window.localStorage.getItem('org.doubango.expert.bandwidth') || "");
  txtSizeVideo.value = (window.localStorage.getItem('org.doubango.expert.video_size') || "");
  cbDebugMessages.checked = (window.localStorage.getItem('org.doubango.expert.disable_debug') == "true");
  cbCallButtonOptions.checked = (window.localStorage.getItem('org.doubango.expert.disable_callbtn_options') == "true");


  if (!bNotUserAction) {
    txtInfo.innerHTML = '<i>Reverted</i>';
  }
}