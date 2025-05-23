const CACHE_NAME = 'pwa-aplikasi-v1';
const RUNTIME_CACHE = 'runtime';

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
      // Precache jika ada halaman utama
      return cache.addAll([
        '/',
        '/offline.html',
      ]);
    })
  );
});

self.addEventListener('fetch', event => {
  if (event.request.method !== 'GET') return;

  event.respondWith(
    caches.match(event.request).then(cachedResponse => {
      return cachedResponse || fetch(event.request).then(response => {
        return caches.open(RUNTIME_CACHE).then(cache => {
          // Cache halaman/menu yang dikunjungi
          cache.put(event.request, response.clone());
          return response;
        });
      });
    }).catch(() => {
      // Jika offline dan halaman belum pernah di-cache
      return caches.match('/offline.html');
    })
  );
});
