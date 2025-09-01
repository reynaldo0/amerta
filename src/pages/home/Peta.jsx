import React from "react";
import Map from "../../components/Map";

const Peta = () => {
  return (
    <section
      id="eksplore"
      className="relative w-full bg-primary-100 bg-cover bg-center bg-no-repeat overflow-hidden"
    >
      {/* Background Parallax */}
      <div
        className="absolute inset-0 bg-[url('/wave/bg.svg')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />

      <div className="absolute top-0 w-full overflow-hidden leading-[0] z-20 will-change-transform">
        <img
          src="/wave/map.png"
          alt="Wave"
          className="w-full h-56 md:h-full object-cover will-change-transform"
        />
      </div>

      {/* Pesawat */}
      <div className="absolute top-30 left-0 w-full z-30 pointer-events-none">
        <img
          src="/illustrasi/pesawat.png"
          alt="Pesawat"
          draggable="false"
          className="w-full md:w-[600px] h-auto animate-plane-flight"
        />
      </div>

      {/* Konten Utama */}
      <div
        className="relative z-10 px-8 md:px-24 lg:px-20 pt-16 lg:pt-16 pb-20 flex flex-col-reverse lg:flex-row-reverse justify-between text-black gap-y-10 lg:gap-x-10 items-center"
        data-aos="fade-up"
        data-aos-duration="800"
      >
        {/* Map Section */}
        <div className="w-full flex flex-col items-center lg:items-start pt-40">
          <div className="mb-4 animate-horizontal-bounce hover:scale-105 transition-transform duration-300">
            <span className="font-bold text-lg text-white">
              Arahkan Kursor ke{" "}
              <span className="text-secondary-200 text-xl">Daerah Anda</span>
            </span>
          </div>
          <div className="w-full">
            <Map />
          </div>
        </div>
      </div>
    </section>
  );
};

export default Peta;
