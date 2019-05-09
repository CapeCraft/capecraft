<?php $utils->getCSS('the-server.css'); ?>
<style>
  .expand {
    display: none;
  }
</style>
<div id="server">
  <div class="flex-box">
    <div class="flex-1">
      <img style="margin-bottom:1vh" class="div-center serverlogo pos-r" src="/assets/img/logo/icon.png">
    </div>
    <div class="flex-3">
      <input type="text" id="serverip" value="play.capecraft.net" readonly>
      <p class="m-0" id="copyinfo">Click the IP to copy</p>
      <h4 class="m-0">Players:
        <?php echo $serverInfo->getInfo()['players']['online'] . "/" . $serverInfo->getInfo()['players']['max']; ?>
      </h4>
    </div>
  </div>
</div>
<div id="serverinfo" class="content">
  <div id="about">
    <img class="div-center logo" src="/assets/img/logo/logo.png">
    <p>
      CapeCraft is a server dedicated to keeping Minecraft's core aspect alive. We are a survival server where you'll be encouraged to work, trade and share with other players. CapeCraft is a survival server with No PVP, No Griefing and No Abuse of any type.
      We try to keep our server family friendly which is why we ask for no swearing and an English only chat on the server. All of our staff are friendly but firm and rule breakers will be swiftly dealt with.
    </p>
    <p>
      The community will thrive and develop into small communities each having their own village name and shops. Certain people will be in charge of each village and this will be entirely up to the people who run them. Players can start their own shops and
      villages just by building them and inviting people over, they can grow from there. All these villages will be player run and no commands will be used to set any villages up, nor will any ranks be given to players who own a village. Each village
      can have their own rules and it's completely up to the players to run and maintain them!
    </p>
    <p>
      Of course, there is always the option to live on your own, not in a village which is always as fun! You can just visit the public shop to buy/sell items and enjoy survival from there.
    </p>
  </div>
  <div name="the-rules">
    <h1 class="text-center">The Rules</h1>
    <p>
      We don't have many rules but we ask that all players follow these rules. Any player caught breaking any rules will be punished. These rules are subject to change at anytime without warning.
    </p>
    <hr>
    <ol>
      <!-- Game Play -->
      <li>Game Play Rules</li>
      <ol>
        <li>No Griefing</li>
        <li>No Stealing</li>
        <li>No Trolling</li>
      </ol>
      <!-- Player -->
      <li>Player Rules</li>
      <ol>
        <li>No Swearing</li>
        <li>No Bullying</li>
        <li>No Abuse</li>
      </ol>
      <!-- Server -->
      <li>Server Rules</li>
      <ol>
        <li>No Spamming</li>
        <li>No Advertising</li>
      </ol>
      <!-- Mod Rules -->
      <li>Modification Rules</li>
      <ol>
        <li>No Mods which post to the chat</li>
        <li>No Mods which give unfair advantages</li>
        <li>No Cheat clients</li>
        <li>Aesthetic, Performance Improvements and HUD mods are allowed</li>
      </ol>
    </ol>
  </div>
  <div name="server-ranks">
    <h1 class="text-center">Server Ranks</h1>
    <p>
      There are a total of 8 Ranks on the server. Guest, Member, Respected, Premium, VIP, Moderator, Administrator, Founder. Here we will talk about each rank, there purpose and there permissions.
    </p>
    <div class="tab">
      <h4 class="button" onclick="showHideRankInfo('guest');">Guest</h4>
      <h4 class="button" onclick="showHideRankInfo('member');">Member</h4>
      <h4 class="button" onclick="showHideRankInfo('respected');">Respected</h4>
      <h4 class="button" onclick="showHideRankInfo('premium');">Premium</h4>
      <h4 class="button" onclick="showHideRankInfo('vip');">VIP</h4>
    </div>
    <div name="guest">
      <div class="expand">
        <p>
          The Guest rank is the default rank given to players upon joining the server. Here are the available commands and permissions
        </p>
        <ul>
          <li>/bal</li>
          <li>/balancetop</li>
          <li>/home /sethome</li>
          <li>/motd</li>
          <li>/msg /r</li>
          <li>/pay</li>
          <li>/spawn</li>
          <li>/tpa /tpaccept /tpdeny /tpahere /tptoggle</li>
          <li>/warp</li>
          <li>/warplist</li>
          <li>Create and Use Shops</li>
          <li>$1000 reward for voting!</li>
          <li>Keep your items on death (NOT XP)</li>
        </ul>
      </div>
    </div>
    <div name="member">
      <div class="expand">
        <p>
          The member rank is earned after 100 play hours on the server. It will be automatically applied and is the rank up from Guest. Here are its permissions and commands
        </p>
        <ul>
          <li>All Guest permissions and commands</li>
          <li>/me</li>
          <li>$2000 reward for voting!</li>
          <li>Set up to 2 homes</li>
          <li>Keep your items and XP on death</li>
          <li>Members will also recieve /fly automatically if they like our server on <a target="_blank" href="https://namemc.com/server/capecraft.net">NameMC</a></li>
        </ul>
      </div>
    </div>
    <div name="respected">
      <div class="expand">
        <p>
          Respected is our first donator rank and can be found on our donation page <a href="/donate">here</a>
        </p>
        <ul>
          <li>All Member permissions and commands</li>
          <li>/echest</li>
          <li>/fly</li>
          <li>/nick</li>
          <li>/skull</li>
          <li>$5000 reward for voting!</li>
          <li>Set up to 4 homes</li>
          <li>Coloured text and nicknames</li>
          <li>Spawn any player skull</li>
        </ul>
      </div>
    </div>
    <div name="premium">
      <div class="expand">
        <p>
          Premium is our second donator rank and can be found on our donation page <a href="/donate">here</a>
        </p>
        <ul>
          <li>All Respected permissions and commands</li>
          <li>/workbench</li>
          <li>/hat</li>
          <li>Set up to 8 homes</li>
          <li>Bypass all teleport cooldowns</li>
        </ul>
      </div>
    </div>
    <div name="vip">
      <div class="expand">
        <p>
          VIP is our third and final donator rank and can be found on our donation page <a href="/donate">here</a>
        </p>
        <ul>
          <li>All Premium permissions and commands</li>
          <li>/setwarp</li>
          <li>/walkspeed</li>
          <li>Create and Place warp signs!</li>
          <li>Set up to 20 homes!</li>
        </ul>
      </div>
    </div>
  </div>
  <div name="staff">
    <h1 class="text-center">Server Staff</h1>
    <p>
      The staff are here to make sure you have the best experience you can whilst on the server.
    </p>
  </div>
<<<<<<< HEAD

=======
  <div id="staff" class="flex-box">
    <div class="flex-2">
      <img class="div-center" src="https://crafatar.com/avatars/ba4161c03a42496c8ae07d13372f3371?helm&size=150">
      <h1>
        <?php echo $usernameHandler->getName('ba4161c03a42496c8ae07d13372f3371'); ?>
      </h1>
      <h3>Founder</h3>
      <p>
        "I am the founder of the server, I make all of the final decisions"
      </p>
    </div>
    <div class="flex-2">
      <!-- WTFDaily -->
      <img class="div-center" src="https://crafatar.com/avatars/617687afc8a846978e5c3ed53b7a335f?helm&size=150">
      <h1>
        <?php echo $usernameHandler->getName('617687afc8a846978e5c3ed53b7a335f'); ?>
      </h1>
      <h3>Administrator</h3>
      <p>
        "I’m here to look after the community! I’ll keep you up to date on all the server news and competitions. Find me on the <a href="/blog">blog page!</a>"
      </p>
    </div>
    <div class="flex-2">
      <!-- Introversion -->
      <img class="div-center" src="https://crafatar.com/avatars/7e75b87133c4420192c06d79b9135be2?helm&size=150">
      <h1>
        <?php echo $usernameHandler->getName('7e75b87133c4420192c06d79b9135be2'); ?>
      </h1>
      <h3>Moderator</h3>
      <p>
        "As a staff member, my job is to deal with rulebreakers and simple bugs and mistakes; if you have either witnessed any rulebreakers or want to report a bug or a mistake, just ask me!"
      </p>
    </div>
    <div class="flex-2">
      <!-- Nuggs_ -->
      <img class="div-center" src="https://crafatar.com/avatars/ad3ba8aed2d84404a52877383dd1bdfb?helm&size=150">
      <h1>
        <?php echo $usernameHandler->getName('ad3ba8aed2d84404a52877383dd1bdfb'); ?>
      </h1>
      <h3>Moderator</h3>
      <p>
        James: "We need you to write something on here, like about you"        
      </p>
      <p>
        Nuggs_: "I like skating? I don't know what to write..."        
      </p>
      <p>
        James: "omg no... I meant like what you do on the server..."
      </p>
    </div>    
  </div>
>>>>>>> a815eeb6cf53868f7f1abeffe5e342d90ba8cc1a
</div>
<?php $utils->getJS('the-server.js'); ?>