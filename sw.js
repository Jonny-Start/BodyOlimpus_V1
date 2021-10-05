// self.addEventListener("install", e => {
//     e.waitUntil(
//         caches.open("static").then(cache => {
//             return cache.addAll(["./", "./src/style.css", "./img/logo1.png"]); //en esta linea se cachea lo que esta dentro del arreglo.
//         })
//     );
// });

self.addEventListener("fetch", e => {
    e.respondWith(
        caches.match(e.request).then(response => {
            return response || fetch(e.request);
        })
    );
});