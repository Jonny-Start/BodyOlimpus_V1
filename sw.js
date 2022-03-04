self.addEventListener("install", e => {
    e.waitUntil(
        caches.open("static").then(cache => {
            //return cache.addAll(["./", "./src/style.css", "./img/logo1.png"]); //en esta linea se cachea lo que esta dentro del arreglo.
            return cache.addAll(["./views/img/Logo_Transparent.png"]);
        })
    );
});

self.addEventListener("fetch", e => {
    e.respondWith(
        caches.match(e.request).then(response => {
            return response || fetch(e.request);
        })
    );
});