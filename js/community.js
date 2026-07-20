(function () {
  "use strict";
  var css =
    ".yt-lazy{position:absolute;inset:0;width:100%;height:100%;border:none;padding:0;cursor:pointer;" +
    "background-size:cover;background-position:center;display:flex;align-items:center;justify-content:center;}" +
    ".yt-lazy::after{content:'';width:72px;height:50px;background:rgba(0,0,0,.75);border-radius:14px;" +
    "position:absolute;transition:background .2s ease;}" +
    ".yt-lazy::before{content:'';border-style:solid;border-width:12px 0 12px 20px;" +
    "border-color:transparent transparent transparent #fff;position:absolute;z-index:1;margin-left:4px;}" +
    ".yt-lazy:hover::after{background:#d96850;}";
  var style = document.createElement("style");
  style.textContent = css;
  document.head.appendChild(style);

  function init() {
    document.querySelectorAll("[data-youtube-id]").forEach(function (el) {
      if (el.children.length > 0) return; // already handled elsewhere
      var vid = el.getAttribute("data-youtube-id");
      if (!vid || vid.indexOf("REPLACE") === 0) return;

      var btn = document.createElement("button");
      btn.type = "button";
      btn.className = "yt-lazy";
      btn.setAttribute(
        "aria-label",
        "Play: " + (el.getAttribute("data-title") || "video"),
      );

      var thumb = new Image();
      thumb.onload = function () {
        var url =
          thumb.naturalWidth > 120
            ? thumb.src
            : "https://i.ytimg.com/vi/" + vid + "/hqdefault.jpg";
        btn.style.backgroundImage = "url('" + url + "')";
      };
      thumb.onerror = function () {
        btn.style.backgroundImage =
          "url('https://i.ytimg.com/vi/" + vid + "/hqdefault.jpg')";
      };
      thumb.src = "https://i.ytimg.com/vi/" + vid + "/maxresdefault.jpg";

      btn.addEventListener("click", function () {
        var iframe = document.createElement("iframe");
        iframe.src =
          "https://www.youtube-nocookie.com/embed/" +
          vid +
          "?autoplay=1&rel=0&enablejsapi=1";
        iframe.title = el.getAttribute("data-title") || "YouTube video";
        iframe.allow =
          "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share";
        iframe.allowFullscreen = true;
        iframe.style.cssText =
          "position:absolute;inset:0;width:100%;height:100%;border:0;";
        el.replaceChildren(iframe);
      });

      el.appendChild(btn);
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
