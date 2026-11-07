(() => {
  'use strict';

  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const AudioCtx = window.AudioContext || window.webkitAudioContext;
  let audioContext = null;
  let audioUnlocked = false;
  let lastHoverSound = 0;

  const SoundManager = {
    enabled: localStorage.getItem('mwc-sound') !== 'off',

    ensure() {
      if (!AudioCtx || !this.enabled) return false;
      try {
        audioContext ||= new AudioCtx();
        if (audioContext.state === 'suspended') audioContext.resume();
        audioUnlocked = true;
        return true;
      } catch (_) { return false; }
    },

    tone(type = 'click') {
      if (!this.enabled || !AudioCtx || !this.ensure()) return;
      try {
        const now = audioContext.currentTime;
        const presets = {
          click:  [[620, 0.045, 0.018, 'sine']],
          hover:  [[820, 0.032, 0.006, 'sine']],
          open:   [[420, 0.10, 0.022, 'sine'], [760, 0.16, 0.012, 'triangle']],
          close:  [[520, 0.07, 0.014, 'sine'], [300, 0.11, 0.010, 'sine']],
          swipe:  [[560, 0.055, 0.012, 'triangle'], [880, 0.085, 0.007, 'sine']],
          focus:  [[740, 0.05, 0.010, 'sine']],
          success:[[520, 0.08, 0.014, 'sine'], [780, 0.13, 0.010, 'sine'], [1040, 0.18, 0.008, 'triangle']],
          welcome:[[392, 0.12, 0.012, 'sine'], [523, 0.16, 0.010, 'sine'], [659, 0.22, 0.008, 'triangle']]
        };
        const voices = presets[type] || presets.click;

        voices.forEach(([freq, dur, vol, wave], i) => {
          const osc = audioContext.createOscillator();
          const gain = audioContext.createGain();
          const filter = audioContext.createBiquadFilter();
          osc.type = wave;
          osc.frequency.setValueAtTime(freq, now + i * 0.018);
          if (type === 'swipe') osc.frequency.exponentialRampToValueAtTime(freq * 1.14, now + dur);
          filter.type = 'lowpass';
          filter.frequency.setValueAtTime(2600, now);
          gain.gain.setValueAtTime(0.0001, now + i * 0.018);
          gain.gain.exponentialRampToValueAtTime(vol, now + 0.012 + i * 0.018);
          gain.gain.exponentialRampToValueAtTime(0.0001, now + dur + i * 0.018);
          osc.connect(filter).connect(gain).connect(audioContext.destination);
          osc.start(now + i * 0.018);
          osc.stop(now + dur + i * 0.018 + 0.02);
        });
      } catch (_) {}
    },

    click(){ this.tone('click'); },
    hover(){ this.tone('hover'); },
    open(){ this.tone('open'); },
    close(){ this.tone('close'); },
    swipe(){ this.tone('swipe'); },
    focus(){ this.tone('focus'); },

    set(value) {
      this.enabled = value;
      localStorage.setItem('mwc-sound', value ? 'on' : 'off');
      this.update();
      if (value) this.tone('success');
    },

    update() {
      document.documentElement.dataset.sound = this.enabled ? 'on' : 'off';
      document.querySelectorAll('[data-sound-toggle]').forEach(b => {
        b.setAttribute('aria-pressed', String(this.enabled));
        b.innerHTML = this.enabled ? '<span>◉</span> Suara On' : '<span>◌</span> Suara Off';
      });
    }
  };
  window.SoundManager = SoundManager;

  const toast = (message, type = 'success') => {
    const stack = document.querySelector('[data-toast-stack]');
    if (!stack) return;
    const el = document.createElement('div');
    el.className = `toast ${type === 'error' ? 'error' : ''}`;
    el.textContent = message;
    stack.append(el);
    setTimeout(() => el.remove(), 3500);
  };

  document.addEventListener('DOMContentLoaded', () => {
    SoundManager.update();

    // Browsers block autoplay audio. The first real pointer/key interaction unlocks the premium SFX engine.
    const unlockAudio = () => {
      if (SoundManager.enabled && !audioUnlocked) SoundManager.tone('welcome');
      window.removeEventListener('pointerdown', unlockAudio);
      window.removeEventListener('keydown', unlockAudio);
    };
    window.addEventListener('pointerdown', unlockAudio, { once:true, passive:true });
    window.addEventListener('keydown', unlockAudio, { once:true, passive:true });

    document.querySelectorAll('[data-sound-toggle]').forEach(b => b.addEventListener('click', () => {
      SoundManager.set(!SoundManager.enabled);
      SoundManager.click();
    }));

    const menu = document.querySelector('[data-mobile-menu]');
    const toggle = document.querySelector('[data-menu-toggle]');
    if (menu && toggle) {
      toggle.addEventListener('click', () => {
        const open = menu.classList.toggle('is-open');
        toggle.setAttribute('aria-expanded', String(open));
        toggle.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
        open ? SoundManager.open() : SoundManager.close();
      });
      menu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => menu.classList.remove('is-open')));
    }

    // General click feedback, excluding carousel cards (handled by modal) and sound toggle (handled above).
    document.querySelectorAll('button,.btn,.site-nav a').forEach(el => {
      if (el.matches('[data-sound-toggle]')) return;
      el.addEventListener('click', () => SoundManager.click(), {passive:true});
    });

    // Rich hover feedback without sound spam.
    document.querySelectorAll('.btn,.person-card,.content-card,.gallery-item,.vision-card,.mission-list>div,.site-nav>a,.carousel-card').forEach(el => {
      el.addEventListener('pointerenter', () => {
        const now = performance.now();
        if (now - lastHoverSound > 160) {
          lastHoverSound = now;
          SoundManager.hover();
        }
      }, {passive:true});
    });

    let activeModal = null;
    let activeTrigger = null;

    const openModal = (modal, trigger) => {
      if (!modal) return;
      if (activeModal && activeModal !== modal) closeModal(activeModal);
      activeModal = modal;
      activeTrigger = trigger || null;
      modal.hidden = false;
      modal.setAttribute('aria-hidden', 'false');
      // Force a layout pass so the opening transition is reliable on mobile browsers.
      modal.getBoundingClientRect();
      requestAnimationFrame(() => modal.classList.add('is-open'));
      document.body.classList.add('modal-open');
      modal.querySelector('.modal-close')?.focus({ preventScroll: true });
      SoundManager.open();
    };

    const closeModal = (modal) => {
      if (!modal) return;
      modal.classList.remove('is-open');
      modal.setAttribute('aria-hidden', 'true');
      modal.hidden = true;
      if (activeModal === modal) {
        document.body.classList.remove('modal-open');
        activeTrigger?.focus?.();
        activeModal = null;
        activeTrigger = null;
      }
      SoundManager.close();
    };

    // One delegated handler for every public card (including all carousel positions).
    // A carousel may still be dragged, but a genuine click on any card opens its detail.
    document.addEventListener('click', event => {
      const trigger = event.target.closest?.('[data-modal-open]');
      if (!trigger) return;
      const modalId = trigger.dataset.modalOpen;
      const modal = modalId ? document.getElementById(modalId) : null;
      if (!modal) return;
      event.preventDefault();
      openModal(modal, trigger);
    });

    document.querySelectorAll('[data-modal]').forEach(modal => {
      modal.setAttribute('aria-hidden', 'true');
      modal.addEventListener('click', e => {
        if (e.target.matches('[data-modal-close]') || e.target === modal) closeModal(modal);
      });
    });

    document.addEventListener('keydown', e => {
      if (e.key === 'Escape' && activeModal) closeModal(activeModal);
    });

    // 3-up carousel: mouse drag, touch swipe, momentum, centered focus, edge opacity.
    document.querySelectorAll('[data-carousel]').forEach(carousel => {
      const track = carousel.querySelector('[data-carousel-track]');
      if (!track) return;

      const items = [...track.querySelectorAll('.carousel-item')];
      let pointerId = null, startX = 0, startScroll = 0;
      let moved = false, lastX = 0, lastTime = 0, velocity = 0;
      let suppressClick = false;
      let focusIndex = -1;

      const paintEdges = () => {
        const rect = track.getBoundingClientRect();
        const center = rect.left + rect.width / 2;
        const half = Math.max(rect.width / 2, 1);

        items.forEach((item, index) => {
          const r = item.getBoundingClientRect();
          const itemCenter = r.left + r.width / 2;
          const d = Math.min(1, Math.abs(itemCenter - center) / half);
          const focus = Math.max(0, 1 - d * 1.62);
          const opacity = Math.max(.38, Math.min(1, .40 + .60 * focus));
          const scale = 1 - Math.max(0, d - .34) * .045;
          item.style.opacity = String(opacity);
          item.style.transform = `scale(${scale}) translateZ(0)`;
          item.classList.toggle('is-edge', opacity < .76);
          item.classList.toggle('is-focus', d < .17);
          if (d < .17) focusIndex = index;
        });
      };

      let paintFrame = 0;
      const repaint = () => {
        cancelAnimationFrame(paintFrame);
        paintFrame = requestAnimationFrame(paintEdges);
      };

      track.addEventListener('scroll', repaint, {passive:true});
      window.addEventListener('resize', repaint, {passive:true});
      paintEdges();
      setTimeout(paintEdges, 80);

      const begin = e => {
        if (e.pointerType === 'mouse' && e.button !== 0) return;
        pointerId = e.pointerId;
        startX = e.clientX;
        lastX = e.clientX;
        startScroll = track.scrollLeft;
        lastTime = performance.now();
        velocity = 0;
        moved = false;
        track.classList.add('is-dragging');
        track.setPointerCapture?.(e.pointerId);
        SoundManager.focus();
      };

      const drag = e => {
        if (pointerId !== e.pointerId) return;
        const dx = e.clientX - startX;
        if (Math.abs(dx) > 5) moved = true;

        const now = performance.now();
        const dt = Math.max(8, now - lastTime);
        velocity = (e.clientX - lastX) / dt;
        lastX = e.clientX;
        lastTime = now;

        track.scrollLeft = startScroll - dx;
        if (moved) e.preventDefault();
        repaint();
      };

      const snapToNearest = () => {
        if (!items.length) return;
        const target = items.reduce((best, item, index) => {
          const r = item.getBoundingClientRect();
          const d = Math.abs((r.left + r.width / 2) - (track.getBoundingClientRect().left + track.clientWidth / 2));
          return d < best.d ? {index, d} : best;
        }, {index:0,d:Infinity}).index;

        items[target]?.scrollIntoView({
          behavior: reduced ? 'auto' : 'smooth',
          block: 'nearest',
          inline: 'center'
        });
      };

      const end = e => {
        if (pointerId !== e.pointerId) return;
        const wasMoved = moved;
        pointerId = null;
        track.classList.remove('is-dragging');

        if (wasMoved) {
          suppressClick = true;
          SoundManager.swipe();

          const momentum = Math.max(-420, Math.min(420, -velocity * 360));
          if (!reduced && Math.abs(momentum) > 16) {
            track.scrollBy({left: momentum, behavior:'smooth'});
            setTimeout(snapToNearest, 240);
          } else {
            snapToNearest();
          }

          setTimeout(() => { suppressClick = false; }, 140);
        } else {
          snapToNearest();
        }
        repaint();
      };

      track.addEventListener('pointerdown', begin);
      track.addEventListener('pointermove', drag, {passive:false});
      track.addEventListener('pointerup', end);
      track.addEventListener('pointercancel', end);
      track.addEventListener('lostpointercapture', () => {
        pointerId = null;
        track.classList.remove('is-dragging');
      });

      track.addEventListener('click', e => {
        if (suppressClick) {
          e.preventDefault();
          e.stopPropagation();
        }
      }, true);

      // Keep arrows for news/standard carousels. Agenda is deliberately cursor-drag only.
      if (!carousel.classList.contains('agenda-carousel')) {
        const move = direction => {
          const item = items[focusIndex >= 0 ? focusIndex : 0];
          const amount = (item?.getBoundingClientRect().width || track.clientWidth / 3) + 18;
          track.scrollBy({left: direction * amount, behavior: reduced ? 'auto' : 'smooth'});
          SoundManager.swipe();
          setTimeout(snapToNearest, 220);
        };
        carousel.querySelector('[data-carousel-next]')?.addEventListener('click', () => move(1));
        carousel.querySelector('[data-carousel-prev]')?.addEventListener('click', () => move(-1));
      }

      if (carousel.classList.contains('agenda-carousel')) {
        const hint = document.createElement('div');
        hint.className = 'carousel-drag-indicator';
        hint.innerHTML = '<span>↔</span> Geser agenda dengan kursor';
        carousel.append(hint);
      }
    });

    // Header scroll state + hero parallax.
    const header = document.querySelector('[data-header]');
    const onScroll = () => header?.classList.toggle('is-scrolled', window.scrollY > 14);
    onScroll();
    window.addEventListener('scroll', onScroll, {passive:true});

    const hero = document.querySelector('.hero-art');
    if (hero && !reduced && window.matchMedia('(pointer:fine)').matches) {
      hero.addEventListener('pointermove', e => {
        const r = hero.getBoundingClientRect();
        const x = (e.clientX-r.left)/r.width-.5;
        const y = (e.clientY-r.top)/r.height-.5;
        hero.style.setProperty('--px', `${x*10}px`);
        hero.style.setProperty('--py', `${y*10}px`);
      });
      hero.addEventListener('pointerleave', () => {
        hero.style.setProperty('--px','0px');
        hero.style.setProperty('--py','0px');
      });
    }

    // Gallery lightbox.
    const lb = document.createElement('div');
    lb.className = 'modal';
    lb.hidden = true;
    lb.innerHTML = '<div class="modal-backdrop" data-lb-close></div><div class="modal-dialog"><button class="modal-close" data-lb-close aria-label="Tutup">×</button><div class="lightbox-content"><img alt=""><p></p></div></div>';
    document.body.append(lb);

    const lbImg = lb.querySelector('img');
    const lbCaption = lb.querySelector('p');

    const openLb = el => {
      lbImg.src = el.dataset.lightbox;
      lbImg.alt = el.dataset.caption || 'Galeri';
      lbCaption.textContent = el.dataset.caption || '';
      lb.hidden = false;
      document.body.classList.add('modal-open');
      lb.querySelector('.modal-close').focus();
      SoundManager.open();
    };

    const closeLb = () => {
      lb.hidden = true;
      document.body.classList.remove('modal-open');
      SoundManager.close();
    };

    document.querySelectorAll('[data-lightbox]').forEach(el => el.addEventListener('click', () => openLb(el)));
    lb.addEventListener('click', e => { if (e.target.matches('[data-lb-close]')) closeLb(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape' && !lb.hidden) closeLb(); });

    // Scroll reveal with stagger support.
    const observer = 'IntersectionObserver' in window ? new IntersectionObserver(entries => entries.forEach(x => {
      if (x.isIntersecting) {
        x.target.classList.add('is-visible');
        SoundManager.focus();
        observer.unobserve(x.target);
      }
    }), {threshold:.08}) : null;
    document.querySelectorAll('[data-reveal]').forEach(el => observer?.observe(el));

    document.querySelectorAll('form[data-confirm]').forEach(form => form.addEventListener('submit', e => {
      if (!confirm(form.dataset.confirm)) e.preventDefault();
    }));

    const ok = document.querySelector('[data-flash-success]');
    const err = document.querySelector('[data-flash-error]');
    if (ok) toast(ok.dataset.flashSuccess);
    if (err) toast(err.dataset.flashError, 'error');
  });
})();
