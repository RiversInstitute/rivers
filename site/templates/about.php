<?php snippet('header', ['headerClass' => 'invert']); ?>
<div class="about">
    <?php snippet('nav'); ?>
    <div class="about__container">
      <div class="text">
        <?= $page->main_content()->kt(); ?>
      </div>
      <div class="text about__rail">
        <div id="intro">
            <?= $page->sidebar_intro()->kt(); ?>
        </div>
        <h3>Staff & Board of Directors</h3>
        <div id="people">
            <?php foreach($page->sidebar_people()->toStructure() as $person): ?>
                <div class="person">
                    <h3 class="person-name"><?= $person->name() ?> <button class="person-bio-toggle">+</button></h3>
                    <p class="person-title"><?= $person->title() ?></p>
                    <div class="person-bio">
                        <?= $person->bio()->kt(); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div id="more">
            <?= $page->more()->kt(); ?>
        <div>
      </div>
    </div>
</div>
<?php snippet('footer'); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const personNames = document.querySelectorAll('.person-name');
        const personBios = document.querySelectorAll('.person-bio');
        
        // Initially hide all bios
        personBios.forEach(bio => {
            bio.style.display = 'none';
        });
        
        // Add click event to each person name
        personNames.forEach((name, index) => {
            name.style.cursor = 'pointer';
            name.addEventListener('click', function() {
                const currentBio = personBios[index];
                const isCurrentlyVisible = currentBio.style.display === 'block';
                
                // Hide all bios first
                personBios.forEach(bio => {
                    bio.style.display = 'none';
                });
                
                // If the clicked bio wasn't visible, show it
                if (!isCurrentlyVisible) {
                    currentBio.style.display = 'block';
                }
            });
        });
    });
</script>
