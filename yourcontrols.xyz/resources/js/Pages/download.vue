<template>
  <main-layout use-container>
    <div class="download">
      <h2>Downloading</h2>
      <div>
<b>Recommended:</b>&nbsp; Download and run the <a href="https://github.com/sequal32/yourcontrolsinstaller/releases/latest/download/installer.zip">installer</a>. <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If the installer does not open for you, you'll need to install <a href="https://go.microsoft.com/fwlink/p/?LinkId=2124703">Webview2</a>.<br><br>
<b>Alternative:</b>&nbsp; A manual zip is available here. Extract, and then drag the YourControls folder inside of the community folder into your Community packages. You can put the folder anywhere else and then launch YourControls.exe.
      </div>
      <h2>Running</h2>
      <div>
        <ol>
          <li>Ensure everybody has the same navdata, scenery, and weather installed.</li>
          <br>
          <li>Launch MSFS, select the same aircraft and spawn location. <b>Do NOT enable multiplayer unless you're on different servers.</b></li>
          <br>
          <li>Once everyone has spawned in, start up the included .exe file. <b>Do NOT run as administrator.</b></li>
          <br>
          <li>
            <div>
              <b>Hoster (designate one person to run):</b>
              <br>
              <br>
              Try all of these options in this order, until one works for you.
              <br>
              <br>
              <b>Cloud P2P</b> utilizes a rendezvous server in order to connect two computers behind a router. Dependending on your router, this may fail and you'll have to use other connection methods. This is the preferred method.
              <ol>
                <li>Click <b>Start Server</b></li>
                <li>In <b>Settings</b>, under the header <b>Active Aircraft</b>, select the .yaml file associated with the aircraft you're flying.</li>
                <li>Give the provided session code to the joiners.</li>
              </ol>
              <br>
              <br>
              <b>Cloud Host</b> utilizes a hosted server that relays traffic between computers. Because of the high traffic this uses, the current connection limit is capped at 100.
              <ol>
                <li>Click <b>Start Server</b></li>
                <li>In <b>Settings</b>, under the header <b>Active Aircraft</b>, select the .yaml file associated with the aircraft you're flying.</li>
                <li>Give the provided session code to the joiners.</li>
              </ol>
              <br>
              <br>
              <b>Direct</b>
              <ol>
                <li>If you have a <a href="https://test-ipv6.com/">IPv6 address</a>, you can simply give that along with the port to the joiners.</li>
                <li>UDP <a href="https://www.youtube.com/watch?v=usSpl0yJFnY">port forward</a> either 25071 or the specified port in the application. If port forwarding is not an option, try enabling UPnP, or use Cloud P2P or Cloud Host.</li>
                <li>In <b>Settings</b>, under the header <b>Active Aircraft</b>, select the .yaml file associated with the aircraft you're flying.</li>
                <li>Click <b>Start Server</b></li>
              </ol>
              <br>
            </div>
          </li>
          <br>
          <li>
            <div>
              <b>Joiners:</b> If given a Session Code, click Cloud Server, paste code, and click Connect <br>
              If given an IP, confirm with the hoster whether it is IPv4 or IPv6, enter port, and click Connect
              <br>
            </div>
          </li>
          <li>
            Fly!
          </li>
              <br>
          <li>
            To transfer control, navigate to the <b>Connections</b> tab, find your partner's name and click <b>Give Control</b>. You can also set a keybinding in the MSFS Controls menu to <b>LAUNCH BAR SWITCH TOGGLE</b> which will give and take control from the first person in the connection list.
          </li>
        </ol>
        <br>
        <br>
        <br>
        <br>
      </div>
    </div>
  </main-layout>
</template>

<script>
import mainLayout from "../Layouts/mainLayout.vue"

export default {
  components: {
    mainLayout
  },
  metaInfo: {
    title: 'Download'
  },
  data: () => ({
    text: ""
  }),
  created() {
  }
}
</script>

<style lang="scss">
.download {
  margin: 50px 15px;
  color: #000;
  ol {
    li {
      margin-left: 30px;
    }
  }
}
</style>