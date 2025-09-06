import React, { useEffect, useState } from "react";
import loadingVideo from "/loading.mp4"; // path video

export default function LoadingScreen({ onLoaded }) {
  const [show, setShow] = useState(true);

  useEffect(() => {
    const timer = setTimeout(() => {
      // fade out loading screen
      const el = document.getElementById("loading-screen");
      if (el) {
        el.style.animation = "fadeOut 2s forwards";
        setTimeout(() => {
          setShow(false);
          if (onLoaded) onLoaded();
        }, 2000); // sesuai durasi fadeOut
      }
    }, 4000 + Math.random() * 2000); // 4-6 detik loading
    return () => clearTimeout(timer);
  }, [onLoaded]);

  const bubbles = Array.from({ length: 15 }, (_, i) => i);

  return show ? (
    <div
      id="loading-screen"
      className="fixed inset-0 z-50 flex flex-col items-center justify-center bg-white backdrop-blur-lg overflow-hidden"
      style={{
        animation: "blurFade 8s forwards", // blur di background, bukan video
      }}
    >
      {/* Gelembung */}
      {bubbles.map((b, i) => (
        <div
          key={b}
          className="absolute rounded-full bg-secondary-300 opacity-50"
          style={{
            width: `${10 + Math.random() * 30}px`,
            height: `${10 + Math.random() * 30}px`,
            left: `${Math.random() * 100}%`,
            bottom: i % 2 === 0 ? `-${Math.random() * 50}px` : undefined,
            top: i % 2 !== 0 ? `-${Math.random() * 50}px` : undefined,
            animation:
              i % 2 === 0
                ? `bubbleMoveUp ${4 + Math.random() * 3}s linear infinite`
                : `bubbleMoveDown ${4 + Math.random() * 3}s linear infinite`,
            animationDelay: `${Math.random() * 2}s`,
          }}
        />
      ))}

      {/* Video tetap bersih, tanpa efek apapun */}
      <video
        src={loadingVideo}
        autoPlay
        loop
        muted
        className="w-32 h-32 object-contain"
      />

      {/* Teks dengan animasi */}
      <p
        className="mt-4 text-gray-600 font-bold text-lg"
        style={{
          animation: "textAppear 3s forwards",
        }}
      >
        Memuat konten...
      </p>
    </div>
  ) : null;
}
