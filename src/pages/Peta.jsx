import React from "react";
import Map from "../components/Map";

const Peta = () => {
  return (
    <section
      id="eksplore"
      className="relative w-full bg-cover bg-center bg-no-repeat overflow-hidden"
    >
      {/* Background Parallax */}
      <div
        className="absolute inset-0 bg-[url('/wave.svg')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />

      {/* Pesawat */}
      <div className="absolute top-10 left-0 w-full z-30 pointer-events-none">
        <img
          src="/pesawat.png" // ganti dengan gambar pesawatmu
          alt="Pesawat"
          className="w-32 md:w-96 h-auto animate-plane-flight"
        />
      </div>

      {/* Konten Utama */}
      <div
        className="relative z-10 px-8 md:px-24 lg:px-20 pt-16 lg:pt-32 pb-20 flex flex-col-reverse lg:flex-row-reverse justify-between text-black gap-y-10 lg:gap-x-10 items-center"
        data-aos="fade-up"
        data-aos-duration="800"
      >
        {/* Map Section */}
        <div className="w-full flex flex-col items-center lg:items-start">
          <div className="hidden md:block mb-4 animate-horizontal-bounce hover:scale-105 transition-transform duration-300">
            <span className="font-bold text-lg">
              Arahkan Kursor ke{" "}
              <span className="text-[#6e3717] text-xl">Daerah Anda</span>
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
