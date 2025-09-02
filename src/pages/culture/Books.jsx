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
    <section className="relative flex justify-center items-center py-10">
      <div style={{ maxWidth: canvasWidth }} className="relative w-full">
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

        {/* UI Overlay (button halaman, dsb) */}
        <div className="absolute inset-0 flex items-center justify-center pointer-events-none">
          <UI />
        </div>
      </div>
    </section>
  );
};

export default CanvasPage;
