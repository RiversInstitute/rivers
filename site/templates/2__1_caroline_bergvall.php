<?php snippet('header', ['headerClass' => 'bergvall']); ?>

<div class="work">
  <iframe 
    class="work__embed"
    src="https://ixt.github.io/passengers/"
  >
  </iframe>
</div>
<?php if ($kirby->request()->query()->get('hidecontent') != "true"): ?>
  <div class="content">  
    <div class="tombstone">
      <div class="tombstone__title text">
        <?= $page->tombstone()->kt(); ?>
      </div>
      <div class="tombstone__description text">
        <?= $page->description()->kt(); ?>
      </div>
    </div>
    <div class="video__container" data-playback-time="<?= $page->playback_begin()->toDate('H:i'); ?>">
      <?= $page->playback_embed_code(); ?>
      <div class="video__message text" style="--message-color: <?= $page->playback_message_color(); ?>">
        <?= $page->playback_message()->kt(); ?>
        <p><span data-upcoming></span></p>
        <p class="video__message__countdown"><span data-countdown></span><p>
      </div>
    </div>
    <div class="bio-credits">
      <div class="bio text">
        <?= $page->bio_credits()->kt(); ?>
      </div>
    </div>
  </div>
  <?php snippet('nav', ['override' => $page->nav_override()->toStructure()]); ?>

  <script>
      document.addEventListener('DOMContentLoaded', () => {
        document.addEventListener('scroll', () => {
          document.documentElement.style.setProperty('--scrollRatio', `${window.scrollY/window.innerHeight}`);
        });
        
        const vc = document.querySelector('[data-playback-time]');
        const pbT = vc.dataset.playbackTime.split(':');
        const pbH = parseInt(pbT[0]);
        const pbM = parseInt(pbT[1]);
        
        const renderVC = () => {
          const now = new Date();
          const begin = new Date();
          begin.setHours(pbH);
          begin.setMinutes(pbM);
          begin.setSeconds(0);

          const end = new Date(begin.getTime());
          end.setHours(end.getHours() + 2);

          const upcomingEl = document.querySelector('[data-upcoming]');
          const countdownEl = document.querySelector('[data-countdown]');
          if (now < begin) {
            // Today at 4:30
            upcomingEl.innerText = `The next viewing for you will be today at ${timeFormatter(begin)}.`;
            countdownEl.innerText = countdownFormatter(begin-now);
            setTimeout(renderVC, 1000);
          } else if (now > end) {
            // Tomorrow at 4:30
            begin.setHours(begin.getHours() + 24);
            end.setHours(end.getHours() + 24);

            upcomingEl.innerText = `The next viewing for you will be tomorrow at ${timeFormatter(begin)}.`;
            countdownEl.innerText = countdownFormatter(begin-now);
            setTimeout(renderVC, 1000);
          } else {
            vc.classList.add('active');
          }
        }

        renderVC();

        setTimeout(() => {
          document.querySelector('.tombstone').classList.add('active');
        }, 5000);
      });

      const timeFormatter = (date) => {
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var ampm = hours >= 12 ? 'pm' : 'am';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0'+minutes : minutes;
        var strTime = hours + ':' + minutes + ' ' + ampm;
        return strTime;
      }

      const countdownFormatter = (ms) => {
        let s = Math.round(ms / 1000);
        let h = Math.floor(s / 3600);
        s %= 3600;
        let m = Math.floor(s / 60);
        s = s % 60;

        h = `${h}`.padStart(2, '0');
        m = `${m}`.padStart(2, '0');
        s = `${s}`.padStart(2, '0');

        return `${h}:${m}:${s}`;
      }
    </script>
  <?php endif; ?>
<?php snippet('footer'); ?>
