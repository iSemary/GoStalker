
  <div class="postit">
      <div class="tab">
          <button class="tablinks signupbtn" type="button" onclick="openPost(event, 'post')" id="defaultOpen"> Post</button>
          <button class="tablinks signupbtn" type="button" onclick="openPost(event, 'vote')"> Vote</button>
          <button class="tablinks signupbtn" type="button" onclick="openPost(event, 'quote')"> Q </button>
      </div>
      <form action="" method="post" id="post-form" enctype="multipart/form-data" class="post-form" accept-charset="UTF-8">
      <div id="post" class="tabcontent">
          <textarea name="postbody" placeholder="Write what happend, what you thinkning about..." id="post-area"></textarea>
          <div class="bottom-sec">
              <img id="preview-post"/>
              <input type="file" id="imgPostid" name="postimg" accept="image/*" hidden>
              <label for="imgPostid" class="Imgpost"></label>
              <button name="p" type="submit" class="accepted signupbtn"></button>
          </div>
      </div>
    </form>
      <!-- <div id="vote" class="tabcontent">
          <label for="file" id="upload">Add image ...</label>
          <input type="file" id="file" accept="image/*">
          <div class="accept-btn" style="float:right; bottom:-60px; position:relative;">

              <button class="accepted signupbtn">Share</button>
          </div>
      </div>-->
      <form action="" method="post" id="quote-form" enctype="multipart/form-data" class="post-form" accept-charset="UTF-8">
      <div id="quote" class="tabcontent">
          <textarea name="qpostbody" placeholder="Your favourite Quotes, Lyrics, Moment..." id="quote-area"></textarea>
          <div class="accept-btn" style="float:right; bottom:64px; position:relative;">
              <button class="accepted signupbtn" type="submit"></button>
          </div>
      </div>
    </form>
  </div>
