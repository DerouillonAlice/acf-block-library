;(function () {
  // Charge Fancybox 5 depuis CDN si absente
  const CDN_JS = 'https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js'
  const CDN_CSS = 'https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css'

  function loadCssOnce(url) {
    if ([...document.styleSheets].some((s) => s.href && s.href.includes('@fancyapps/ui')))
      return Promise.resolve()
    return new Promise((res) => {
      const l = document.createElement('link')
      l.rel = 'stylesheet'
      l.href = url
      l.onload = res
      document.head.appendChild(l)
    })
  }

  function loadJsOnce(url) {
    if (window.Fancybox) return Promise.resolve()
    return new Promise((res) => {
      const s = document.createElement('script')
      s.src = url
      s.async = true
      s.onload = res
      document.head.appendChild(s)
    })
  }

  function boot() {
    const scopes = document.querySelectorAll('.acf-video-fancybox')
    if (!scopes.length) return

    loadCssOnce(CDN_CSS)
      .then(() => loadJsOnce(CDN_JS))
      .then(() => {
        // Fancybox.bind('[data-fancybox]', { Thumbs: false, Toolbar: { display: ['close'] } });
      })
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot)
  } else {
    boot()
  }
})()
