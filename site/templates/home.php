<?php snippet('header'); ?>
<?php snippet('nav'); ?>

<div class="layout-wrapper--full">

  <div class="main-content">

    <div class="main-content__item text">

      <div class="main-content__item text__title" onclick="openorcloseBody()">
        <?= $page->main_content_title()->kt(); ?>
      </div>

      <div class="main-content__item text__body" id="body_text">
        <?= $page->main_content_body()->kt(); ?>
      </div>

    </div>
  </div>

  <div class="bibliography">
      <div id="Bibliography_title" onclick="openNav()"> Bibliography </div>

      <div id="bibliography_info">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" >&times;</a>
          <br><?php foreach ($page->bibliography_item()->toStructure() as $bib): ?>
              <?= $bib->citation().kt();
              echo "<br>";
              echo "<br>";
              echo "<style>{ padding-left: 22px ;
            text-indent: -22px;}</style>";
              ?>
          <?php endforeach ?>
     </div>
  </div>


<script>


function openorcloseBody() {

  if (document.getElementById("body_text").style.visibility == "visible") {
    document.getElementById("body_text").style.visibility = "hidden";
  }
  else {
  document.getElementById("body_text").style.visibility = "visible";
  }
}

let openBtn = document.querySelector("#Bibliography_title");
openBtn.addEventListener("click", () => {
   showNav();
});
let closeBtn = document.querySelector(".closebtn");
closeBtn.addEventListener("click", () => {
   hideNav();
});
function showNav() {
   document.querySelector("#bibliography_info").style.width = "300px";
   document.querySelector("#Bibliography_title").style.marginRight = "300px";
}
function hideNav() {
   document.querySelector("#bibliography_info").style.width = "0";
   document.querySelector("#Bibliography_title").style.marginRight = "0px";
 }


</script>

<?php snippet('footer'); ?>
</div>
