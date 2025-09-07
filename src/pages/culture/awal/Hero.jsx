import React, { useState, useEffect, Suspense, useMemo } from "react";
import { Canvas } from "@react-three/fiber";
import { Experience } from "../../../components/models/Experience";
import { Html } from "@react-three/drei";

// Loader Component
function Loader() {
  return (
    <Html center>
      <div className="flex flex-col items-center justify-center text-white">
        <div className="w-12 h-12 border-4 border-t-transparent border-secondary-300 rounded-full animate-spin mb-4"></div>
        <span className="text-sm text-primary-200 animate-pulse">Loading</span>
      </div>
    </Html>
  );
}

export default function Hero() {
  const [windowWidth, setWindowWidth] = useState(
    typeof window !== "undefined" ? window.innerWidth : 1024
  );

  useEffect(() => {
    const handleResize = () => setWindowWidth(window.innerWidth);
    window.addEventListener("resize", handleResize);
    return () => window.removeEventListener("resize", handleResize);
  }, []);

  // Responsiveness settings
  const canvasSize = useMemo(() => {
    if (windowWidth < 640) {
      return { width: "100%", height: "40vh", posX: -0.1 };
    } else if (windowWidth < 1024) {
      return { width: "100%", height: "50vh", posX: -0.05 };
    } else {
      return { width: "800px", height: "500px", posX: 0 };
    }
  }, [windowWidth]);

  return (
    <section className="relative w-full min-h-screen flex items-center text-white overflow-hidden">
      {/* Background Parallax */}
      <div
        className="absolute inset-0 bg-[url('/wave/budaya.png')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />

      {/* Decorations */}
      <div className="absolute inset-0">
        <div className="absolute w-48 h-48 md:w-72 md:h-72 rounded-full bg-primary-100 opacity-20 blur-3xl top-10 left-10 animate-pulse" />
        <div className="absolute w-72 h-72 md:w-96 md:h-96 rounded-full bg-primary-100 opacity-20 blur-3xl bottom-10 right-10 animate-bounce" />
      </div>

      {/* Content */}
      <div className="relative z-10 container mx-auto px-6 flex flex-col-reverse lg:flex-row items-center gap-12">
        {/* Text */}
        <div className="flex-1 text-center lg:text-left">
          <h1
            className="text-4xl sm:text-5xl md:text-6xl font-extrabold text-primary-100 leading-tight"
            data-aos="fade-down"
          >
            Budaya Indonesia
            <br />
            <span className="bg-gradient-to-r from-primary-100 via-secondary-300 to-primary-200 bg-clip-text text-transparent">
              Kekayaan Nusantara
            </span>
          </h1>

          <p
            className="mt-6 text-base sm:text-lg md:text-xl text-primary-100 max-w-lg mx-auto lg:mx-0"
            data-aos="fade-right"
            data-aos-delay="200"
          >
            Jelajahi ragam{" "}
            <span className="text-secondary-300 font-semibold">tradisi</span>,
            <span className="text-secondary-300 font-semibold"> seni</span>, dan
            <span className="text-secondary-300 font-semibold">
              {" "}
              kearifan lokal
            </span>{" "}
            dari Sabang sampai Merauke. Temukan cerita unik yang membentuk
            identitas bangsa Indonesia.
          </p>

          {/* CTA */}
          <div
            className="mt-8 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start"
            data-aos="zoom-in"
            data-aos-delay="400"
          >
            <a
              href="#pulau"
              className="px-6 sm:px-8 py-3 rounded-2xl font-bold bg-secondary-300 text-white text-sm sm:text-base"
            >
              Jelajahi Sekarang
            </a>
          </div>
        </div>

        {/* 3D Object */}
        <div
          className="flex-1 flex justify-center relative w-full pt-20 md:pt-0"
          data-aos="fade-left"
          data-aos-delay="600"
        >
          <div
            className="relative w-full max-w-full"
            style={{ maxWidth: canvasSize.width }}
          >
            <Canvas
              shadows={false}
              camera={{ position: [0, 1, 3], fov: 45 }}
              style={{ height: canvasSize.height }}
              dpr={[1, 1.5]}
            >
              <Suspense fallback={<Loader />}>
                <group position={[canvasSize.posX, 0, 0]}>
                  <Experience />
                </group>
              </Suspense>
            </Canvas>
          </div>
        </div>
      </div>
    </section>
  );
}
