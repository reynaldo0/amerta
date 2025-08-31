import { Environment, OrbitControls } from "@react-three/drei";
import { Canvas } from "@react-three/fiber";
import { useRef, useState } from "react";
import { useMediaQuery } from "react-responsive";
import Garuda from "../components/Models/Garuda";

const About = () => {

  // State for responsive canvas size
  const canvasRef = useRef(null);
  const [scale] = useState(1); // Scale for 3D object

  const isMobile = useMediaQuery({ maxWidth: 768 }); // Detect mobile screen size

  return (
    <div
      className="flex pt-16 flex-col md:pt-7 md:flex-row items-center justify-center md:py-24 space-y-8 md:space-y-0 md:space-x-8 bg-red-600 md:bg-transparent"
      id="about"
    >
      {/* Left Section */}
      <div className="bg-red-600 text-white p-6 md:p-12 rounded-b-[20px] md:rounded-r-[40px] flex flex-col items-start space-y-4 md:space-y-6">
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

      {/* Right Section with Custom Pagination */}
      <div className="flex flex-col items-center text-center space-y-4 w-full md:w-[130%]">
        <div
          ref={canvasRef}
          className="w-full h-[200px] scale-125 md:scale-100 mr-32 md:mr-0 md:h-[500px]"
        >
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
            <Garuda scale={scale} /> {/* Apply dynamic scale */}
            <OrbitControls
              enableZoom={false} // Disable zoom on mobile
              enableRotate={!isMobile} // Disable rotation on mobile
              enablePan={false} // Disable panning on mobile
            />
          </Canvas>
        </div>
      </div>
    </div>
  );
};

export default About;