// This is the "Offline copy of pages" service worker

/*
const CACHE = "pwabuilder-offline";

importScripts('https://storage.googleapis.com/workbox-cdn/releases/5.1.2/workbox-sw.js');

self.addEventListener("message", (event) => {
  if (event.data && event.data.type === "SKIP_WAITING") {
    self.skipWaiting();
  }
});

workbox.routing.registerRoute(
  new RegExp('/*'),
  new workbox.strategies.StaleWhileRevalidate({
    cacheName: CACHE
  })
);*/



// Service Worker Aman untuk PWA Offline
// Tambahkan ini ke paling atas sementara
self.__WB_DISABLE_DEV_LOGS = true;


const CACHE = "pwabuilder-offline";
importScripts('https://storage.googleapis.com/workbox-cdn/releases/5.1.2/workbox-sw.js');

self.addEventListener("message", (event) => {
  if (event.data && event.data.type === "SKIP_WAITING") {
    self.skipWaiting();
  }
});

// 1. Cache hanya file statis (CSS, JS, gambar)
workbox.routing.registerRoute(
  /\.(?:js|css|png|jpg|jpeg|svg|woff2?)$/,
  new workbox.strategies.StaleWhileRevalidate({
    cacheName: 'static-resources',
  })
);

// 2. Cache halaman utama saja untuk offline
workbox.routing.registerRoute(
  /\/$/,
  new workbox.strategies.NetworkFirst({
    cacheName: CACHE
  })
);

// 3. Jangan cache API, ambil langsung dari server
workbox.routing.registerRoute(
  /\/pembayaran\/getTagihanForPembayaran/,
  new workbox.strategies.NetworkOnly()


);
