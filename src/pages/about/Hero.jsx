import { Environment, OrbitControls } from "@react-three/drei";
import { Canvas } from "@react-three/fiber";
import { useRef, useState, useEffect } from "react";
import Garuda from "../../components/models/Garuda";

const HeroAbout = () => {
  const canvasRef = useRef(null);
  const [scale] = useState(1);

  // State untuk cek apakah mobile
  const [isMobile, setIsMobile] = useState(window.innerWidth <= 768);

  // State untuk parallax
  const [offsetY, setOffsetY] = useState(0);

  useEffect(() => {
    const handleResize = () => {
      setIsMobile(window.innerWidth <= 768);
    };
    const handleScroll = () => {
      setOffsetY(window.scrollY);
    };

    window.addEventListener("resize", handleResize);
    window.addEventListener("scroll", handleScroll);

    return () => {
      window.removeEventListener("resize", handleResize);
      window.removeEventListener("scroll", handleScroll);
    };
  }, []);

  return (
    <div
      className="flex pt-32 flex-col-reverse md:pt-28 md:flex-row items-center justify-center md:py-24 md:space-y-0 md:space-x-8 bg-white md:bg-transparent relative overflow-hidden"
      id="about"
    >
      {/* Left Section */}
      <div className="bg-primary-100 rounded-t-3xl text-white p-6 md:p-12 md:rounded-r-[40px] flex flex-col items-start space-y-4 md:space-y-6 relative z-10">
        <h2
          className="text-xl md:text-5xl font-serif leading-tight text-left"
          data-aos="fade-up"
          data-aos-duration="800"
        >
          Kami membawa visi untuk menjadi gerakan utama dalam mempersiapkan
          generasi muda menuju Indonesia emas 2045.
        </h2>
        <hr
          className="border border-white w-1/2 md:w-1/4 my-4 md:my-6"
          data-aos="fade-up"
          data-aos-duration="9000"
        />
        <p
          className="text-sm md:text-2xl font-light text-left"
          data-aos="fade-up"
          data-aos-duration="1000"
        >
          Generasi muda merupakan fondasi untuk masa depan yang lebih baik.
          Mereka akan menjadi sumber daya terpenting dalam menghadapi tantangan
          global dan berperan aktif dalam memajukan berbagai sektor dan
          menciptakan perubahan positif yang berkelanjutan.
        </p>
      </div>

      {/* Right Section */}
      <div className="flex flex-col items-center text-center space-y-4 w-full md:w-[130%] relative z-10">
        <div
          ref={canvasRef}
          className="w-full h-[200px] scale-125 md:scale-100 mr-32 md:mr-0 md:h-[500px]"
        >
          <img
            className="absolute md:left-0 left-10 -bottom-10 md:bottom-10 w-56 h-56 rounded-full opacity-70"
            src="/illustrasi/batik.png"
            alt="Batik Left"
            style={{
              transform: `translateX(${offsetY * 0.4}px) translateY(${
                offsetY * 0.2
              }px)`,
              filter: `blur(${Math.min(offsetY * 0.015, 6)}px)`,
            }}
          />

          {/* Parallax Object 2 */}
          <img
            src="/illustrasi/batik2.png"
            alt="Batik Right"
            className="absolute -right-20 -top-20 md:right-0 md:top-0 w-56 h-56 opacity-70"
            style={{
              transform: `translateX(-${offsetY * 0.5}px) translateY(${
                offsetY * 0.3
              }px)`,
              filter: `blur(${Math.min(offsetY * 0.015, 6)}px)`,
            }}
          />
          <Canvas
            className="md:pt-24"
            camera={{ position: [0, 1, 3], fov: 50 }}
            style={{ width: "100%", height: "100%" }}
          >
            <Environment preset="dawn" />
            <ambientLight intensity={0.5} />
            <spotLight
              position={[10, 10, 10]}
              angle={0.15}
              penumbra={1}
              intensity={1}
              castShadow
            />
            <Garuda scale={scale} />
            <OrbitControls
              enableZoom={false}
              enableRotate={!isMobile}
              enablePan={false}
            />
          </Canvas>
        </div>
      </div>
    </div>
  );
};

export default HeroAbout;
