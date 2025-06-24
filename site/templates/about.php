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
                    <h3 class="person-name">
                        <?= $person->name() ?>
                        <?php if($person->bio()->isNotEmpty()): ?>
                            <button class="person-bio-toggle">+</button>
                        <?php endif; ?>
                    </h3>
                    <p class="person-title"><?= $person->title() ?></p>
                    <?php if($person->bio()->isNotEmpty()): ?>
                        <div class="person-bio">
                            <?= $person->bio()->kt(); ?>
                        </div>
                    <?php endif; ?>
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
        const toggleButtons = document.querySelectorAll('.person-bio-toggle');
        const personBios = document.querySelectorAll('.person-bio');
        
        // Initially hide all bios
        personBios.forEach(bio => {
            bio.style.display = 'none';
        });
        
        // Function to toggle bio
        function toggleBio(personDiv) {
            const currentBio = personDiv.querySelector('.person-bio');
            const isCurrentlyVisible = currentBio.style.display === 'block';
            
            // Hide all bios first
            personBios.forEach(bio => {
                bio.style.display = 'none';
            });
            
            // If the clicked bio wasn't visible, show it
            if (!isCurrentlyVisible) {
                currentBio.style.display = 'block';
            }
        }
        
        // Add click event to each toggle button
        toggleButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const personDiv = this.closest('.person');
                toggleBio(personDiv);
            });
        });
        
        // Add click event to person names that have bio toggles
        toggleButtons.forEach(button => {
            const personName = button.closest('.person-name');
            personName.style.cursor = 'pointer';
            personName.addEventListener('click', function(e) {
                // Don't trigger if clicking the button itself
                if (e.target === button) return;
                
                const personDiv = this.closest('.person');
                toggleBio(personDiv);
            });
        });
    });
</script>
