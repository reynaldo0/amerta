import React, { useState, useEffect } from "react";
import { Canvas } from "@react-three/fiber";
import { Suspense } from "react";
import { Experience } from "../../components/models/Experience";
import { UI } from "../../components/models/UI";

const CanvasPage = () => {
  const [windowWidth, setWindowWidth] = useState(window.innerWidth);
  const [windowHeight, setWindowHeight] = useState(window.innerHeight);

  useEffect(() => {
    const handleResize = () => {
      setWindowWidth(window.innerWidth);
      setWindowHeight(window.innerHeight);
    };
    window.addEventListener("resize", handleResize);
    return () => window.removeEventListener("resize", handleResize);
  }, []);

  const canvasWidth = windowWidth < 768 ? windowWidth * 0.9 : 800;
  const canvasHeight = windowWidth < 768 ? windowHeight * 0.4 : 500;

  const positionX = windowWidth < 768 ? -0.1 : 0;

  return (
    <section className="relative py-10 px-5">
      <div className="text-center mb-8">
        <p
          className="text-primary mb-4 text-xl md:text-2xl"
          data-aos="fade-up"
          data-aos-duration="900"
        >
          Jelajahi Budaya Nusantara dalam 3D
        </p>
        <p
          className="font-bold text-4xl md:text-6xl"
          data-aos="fade-up"
          data-aos-duration="1100"
        >
          Buku Budaya Interaktif
        </p>
      </div>

      <div className="relative">
        <div
          className="relative mx-auto w-full"
          style={{ maxWidth: canvasWidth }}
        >
          <Canvas
            shadows
            camera={{ position: [0, 1, 3], fov: 45 }}
            style={{ height: canvasHeight }}
          >
            <group position={[positionX, 0, 0]}>
              <Suspense fallback={null}>
                <Experience />
              </Suspense>
            </group>
          </Canvas>
        </div>
        <div className="absolute inset-0 flex items-center justify-center pointer-events-none">
          <UI />
        </div>
      </div>
    </section>
  );
};

export default CanvasPage;
