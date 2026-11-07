(() => {
  'use strict';
  const reduced = window.matchMedia?.('(prefers-reduced-motion: reduce)').matches;
  const $ = (s, root=document) => root.querySelector(s);
  const $$ = (s, root=document) => [...root.querySelectorAll(s)];

  const SFX = window.SoundManager || { click(){}, hover(){}, open(){}, close(){}, swipe(){}, focus(){} };

  // Navbar: normal at top, compact floating pill after scroll. No page-wide blur.
  const header = $('[data-header]');
  const shell = $('[data-nav-shell]');
  const updateNav = () => {
    const scrolled = window.scrollY > 48;
    header?.classList.toggle('is-scrolled', scrolled);
    shell?.classList.toggle('nav-pill-active', scrolled);
  };
  updateNav();
  window.addEventListener('scroll', updateNav, {passive:true});

  // Lightweight NU depth grid: CSS-only visuals + tiny pointer drift + optional drag.
  const drift = $('[data-nu-drift]');
  if (drift) {
    let dragging=false, sx=0, sy=0, ox=0, oy=0, pid=null;
    drift.addEventListener('pointerdown', e=>{
      dragging=true; pid=e.pointerId; sx=e.clientX; sy=e.clientY;
      const cs=getComputedStyle(drift);
      const mx=parseFloat(cs.getPropertyValue('--drag-x'))||0, my=parseFloat(cs.getPropertyValue('--drag-y'))||0;
      ox=mx; oy=my; drift.setPointerCapture?.(e.pointerId); drift.style.cursor='grabbing'; SFX.focus();
    });
    drift.addEventListener('pointermove', e=>{
      if(!dragging || e.pointerId!==pid) return;
      drift.style.setProperty('--drag-x', `${ox+e.clientX-sx}px`);
      drift.style.setProperty('--drag-y', `${oy+e.clientY-sy}px`);
    }, {passive:true});
    const end=()=>{dragging=false;pid=null;drift.style.cursor='grab';};
    drift.addEventListener('pointerup',end); drift.addEventListener('pointercancel',end);
  }
  if (drift && !reduced && matchMedia('(pointer:fine)').matches) {
    const parent = drift.parentElement;
    parent?.addEventListener('pointermove', e => {
      const r = parent.getBoundingClientRect();
      const x = (e.clientX-r.left)/r.width-.5;
      const y = (e.clientY-r.top)/r.height-.5;
      drift.style.setProperty('--dx', `${x*24}px`);
      drift.style.setProperty('--dy', `${y*18}px`);
    }, {passive:true});
    parent?.addEventListener('pointerleave', () => {
      drift.style.setProperty('--dx','0px'); drift.style.setProperty('--dy','0px');
    }, {passive:true});
  }

  // Keep every modal directly under <body>: transformed/revealed/carousel ancestors can
  // otherwise become the containing block for position:fixed and shift dialogs off-center.
  const modalOrigins = new WeakMap();
  $$('[data-modal]').forEach(modal => {
    modalOrigins.set(modal, { parent: modal.parentNode, next: modal.nextSibling });
    document.body.appendChild(modal);
    modal.setAttribute('aria-hidden', 'true');
  });

  // Robust, independent modal engine. It intentionally does not depend on carousel state for news.
  let currentModal = null;
  let currentTrigger = null;
  const openModal = (modal, trigger) => {
    if (!modal) return;
    if (currentModal && currentModal !== modal) closeModal(currentModal);
    currentModal = modal; currentTrigger = trigger || null;
    modal.hidden = false;
    modal.setAttribute('aria-hidden','false');
    document.body.classList.add('modal-open');
    requestAnimationFrame(() => modal.classList.add('is-open'));
    $('.modal-close', modal)?.focus({preventScroll:true});
    SFX.open();
  };
  const closeModal = modal => {
    if (!modal) return;
    modal.classList.remove('is-open');
    setTimeout(() => { modal.hidden = true; }, reduced ? 0 : 220);
    modal.setAttribute('aria-hidden','true');
    document.body.classList.remove('modal-open');
    const triggerToRestore = currentTrigger;
    currentModal = null; currentTrigger = null;
    triggerToRestore?.focus?.({preventScroll:true});
    SFX.close();
  };

  // Capture phase ensures cards inside any transformed/animated wrapper still trigger.
  document.addEventListener('click', e => {
    const trigger = e.target.closest?.('[data-modal-open]');
    if (trigger) {
      // Semua kartu konten yang memiliki data-modal-open harus bisa langsung dibuka.
      // Posisi/fokus carousel tetap dipertahankan sebagai efek visual saja, bukan syarat klik.
      const id = trigger.getAttribute('data-modal-open');
      const modal = id ? document.getElementById(id) : null;
      if (modal) { e.preventDefault(); e.stopPropagation(); openModal(modal, trigger); return; }
    }
    const closer = e.target.closest?.('[data-modal-close]');
    if (closer) {
      const modal = closer.closest('[data-modal]');
      if (modal) { e.preventDefault(); closeModal(modal); }
    }
  }, true);

  document.addEventListener('keydown', e => {
    if (!currentModal) return;
    if (e.key === 'Escape') { e.preventDefault(); closeModal(currentModal); return; }
    if (e.key === 'Tab') {
      const focusable = $$('a[href],button:not([disabled]),input:not([disabled]),textarea:not([disabled]),select:not([disabled]),[tabindex]:not([tabindex="-1"])', currentModal)
        .filter(el => el.getClientRects().length && getComputedStyle(el).visibility !== 'hidden');
      if (!focusable.length) { e.preventDefault(); return; }
      const first = focusable[0], last = focusable[focusable.length - 1];
      if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
      else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
    }
  });

  // Carousel presentation: agenda = 5 visible, middle 3 clickable; news = 3 visible and all readable.
  $$('[data-carousel]').forEach(carousel => {
    const track = $('[data-carousel-track]', carousel);
    if (!track) return;
    const items = $$('.carousel-item', track);
    const isAgenda = carousel.classList.contains('agenda-carousel');
    let raf = 0;
    const paint = () => {
      cancelAnimationFrame(raf);
      raf = requestAnimationFrame(() => {
        const tr = track.getBoundingClientRect();
        const center = tr.left + tr.width/2;
        const ranked = items.map((item,index) => {
          const r=item.getBoundingClientRect();
          return {item,index,d:Math.abs(r.left+r.width/2-center)};
        }).sort((a,b)=>a.d-b.d);
        const clickable = new Set(ranked.slice(0,3).map(x=>x.index));
        items.forEach((item,index) => {
          const r=item.getBoundingClientRect();
          const d=Math.abs(r.left+r.width/2-center);
          const norm=Math.min(1,d/Math.max(tr.width*.45,1));
          const opacity=isAgenda ? Math.max(.22,1-norm*.92) : Math.max(.35,1-norm*.72);
          const scale=isAgenda ? (clickable.has(index) ? (ranked.findIndex(x=>x.index===index)===0?1.02:.965) : .90) : (d<tr.width*.18?1.015:.96);
          item.style.opacity=String(opacity);
          item.style.transform=`translate3d(0,0,0) scale(${scale})`;
          item.classList.toggle('is-focus', ranked[0]?.index===index);
          item.classList.toggle('is-clickable', isAgenda ? clickable.has(index) : true);
          item.setAttribute('aria-disabled', String(isAgenda && !clickable.has(index)));
        });
      });
    };
    track.addEventListener('scroll', paint, {passive:true});
    window.addEventListener('resize', paint, {passive:true});
    paint(); setTimeout(paint,100);

    if (isAgenda) {
      let down=false,startX=0,startScroll=0,pointerId=null,moved=false;
      const downFn=e=>{ if(e.pointerType==='mouse'&&e.button!==0)return; down=true;pointerId=e.pointerId;startX=e.clientX;startScroll=track.scrollLeft;moved=false;track.classList.add('is-dragging');track.setPointerCapture?.(e.pointerId);SFX.focus(); };
      const moveFn=e=>{if(!down||e.pointerId!==pointerId)return;const dx=e.clientX-startX;if(Math.abs(dx)>6)moved=true;track.scrollLeft=startScroll-dx;if(moved)e.preventDefault();paint();};
      const upFn=e=>{if(!down||e.pointerId!==pointerId)return;down=false;pointerId=null;track.classList.remove('is-dragging');if(moved)SFX.swipe();paint();};
      track.addEventListener('pointerdown',downFn);track.addEventListener('pointermove',moveFn,{passive:false});track.addEventListener('pointerup',upFn);track.addEventListener('pointercancel',upFn);
      // Semua item agenda tetap dapat diklik untuk membuka modal; drag/swipe carousel tetap aktif.
    }
  });

  // Micro-interactions: use transform/opacity only for low-cost animation.
  if (!reduced && matchMedia('(pointer:fine)').matches) {
    $$('.person-card,.content-card,.vision-card,.mission-list>div,.gallery-item,.btn').forEach(el => {
      el.addEventListener('pointerenter',()=>{el.classList.add('is-hovered');SFX.hover();},{passive:true});
      el.addEventListener('pointerleave',()=>el.classList.remove('is-hovered'),{passive:true});
    });
  }

  // Staggered reveal.
  const reveals=$$('[data-reveal]');
  if ('IntersectionObserver' in window) {
    const io=new IntersectionObserver(entries=>entries.forEach(entry=>{
      if(entry.isIntersecting){entry.target.classList.add('is-visible');io.unobserve(entry.target);}
    }),{threshold:.08,rootMargin:'0px 0px -5% 0px'});
    reveals.forEach((el,i)=>{el.style.setProperty('--reveal-delay',`${Math.min(i%8,7)*45}ms`);io.observe(el);});
  } else reveals.forEach(el=>el.classList.add('is-visible'));
})();
