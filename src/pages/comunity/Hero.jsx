import React, { useEffect } from "react";
import AOS from "aos";
import "aos/dist/aos.css";

export default function HeroCommunity() {
  useEffect(() => {
    AOS.init({
      duration: 1000, // durasi animasi
      once: true, // hanya sekali animasi
    });
  }, []);

  return (
    <section className="w-full bg-white py-20 relative overflow-hidden">
      {/* Background Parallax */}
      <div
        className="absolute inset-0 bg-[url('/wave/komunitas.png')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />

      <div className="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center px-6 relative z-10">
        {/* Left: Image */}
        <div className="relative group" data-aos="fade-right">
          <img
            src="/illustrasi/komunitas.png"
            alt="Komunitas Budaya"
            className="rounded-3xl shadow-2xl bg-primary-200 w-full object-cover transform group-hover:scale-105 transition duration-500"
          />
          {/* Overlay effect */}
          <div className="absolute inset-0 bg-gradient-to-tr from-black/40 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition duration-500"></div>
        </div>

        {/* Right: Content */}
        <div data-aos="fade-left">
          <h1 className="text-4xl md:text-5xl font-extrabold leading-tight">
            <span className="bg-primary-100 bg-clip-text text-transparent">
              Lestarikan Budaya Nusantara
            </span>
          </h1>
          <p className="mt-4 text-lg text-gray-700">
            Bergabunglah dengan komunitas budaya untuk mengenal, belajar, dan
            melestarikan kekayaan tradisi lokal seperti wayang, gamelan, tarian,
            dan batik.
          </p>

          {/* Episode Card */}
          <div
            className="flex items-center gap-4 bg-white border border-gray-200 rounded-2xl p-5 mt-8 shadow-lg hover:shadow-xl transition duration-300"
            data-aos="zoom-in"
            data-aos-delay="200"
          >
            <img
              src="/illustrasi/wayang.png"
              alt="Wayang Kulit"
              className="w-16 h-16 rounded-xl object-cover shadow-md"
            />
            <div className="flex-1">
              <p className="text-sm font-semibold text-gray-800">
                Episode 12 - Filosofi Wayang Kulit
              </p>
              <p className="text-sm text-gray-500">
                Mengenal makna kehidupan dari pertunjukan wayang tradisional
              </p>
              <button className="mt-2 inline-flex items-center text-secondary-300 text-sm font-medium hover:text-secondary-300/80 transition">
                <i className="fas fa-play-circle mr-2 text-lg"></i> Putar
                Episode
              </button>
            </div>
          </div>

          {/* Stats */}
          <div
            className="flex gap-6 mt-8"
            data-aos="fade-up"
            data-aos-delay="400"
          >
            <div className="flex-1 bg-white border border-gray-200 rounded-2xl p-6 text-center shadow-md hover:shadow-xl transition duration-300">
              <p className="text-3xl font-bold text-gray-900">50k+</p>
              <p className="text-gray-600 text-sm">Anggota Komunitas</p>
            </div>
            <div className="flex-1 bg-primary-100 rounded-2xl p-6 text-center shadow-md hover:shadow-xl transition duration-300">
              <p className="text-3xl font-bold text-white">200+</p>
              <p className="text-gray-100 text-sm">Acara Budaya</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
