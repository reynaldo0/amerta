import React from "react";
import { Swiper, SwiperSlide } from "swiper/react";
import "swiper/css";
import "swiper/css/navigation";
import { Navigation } from "swiper/modules";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faArrowLeft, faArrowRight } from "@fortawesome/free-solid-svg-icons";

export default function Tokoh() {
  return (
    <section className="relative w-full min-h-screen text-white overflow-hidden">
      <img
        src="/wave/tokoh.png"
        alt="Wave"
        className="hidden md:block w-full h-full object-cover will-change-transform"
      />
      <div
        className="absolute inset-0 bg-[url('/wave/budaya.png')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />
      <h2 className="text-4xl md:text-5xl font-extrabold text-center text-primary-200 tracking-tight">
        Tokoh Budaya Nusantara
      </h2>

      <div className="flex items-center justify-center py-24 relative">
        {/* Swiper */}
        <Swiper
          modules={[Navigation]}
          navigation={{
            prevEl: ".custom-prev",
            nextEl: ".custom-next",
          }}
          spaceBetween={30}
          slidesPerView={1}
          loop={true}
          className="max-w-6xl w-full"
        >
          {/* Slide 1 */}
          <SwiperSlide>
            <div className="bg-primary-200/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8 md:p-12 grid md:grid-cols-2 gap-8 border border-white/20">
              <div className="grid grid-cols-2 gap-4">
                <img
                  src="/illustrasi/wayang.png"
                  alt="Mona Lisa"
                  className="rounded-2xl shadow-lg object-cover w-full h-48 md:h-64 transform transition-transform duration-500 hover:scale-105"
                />
                <img
                  src="/illustrasi/wayang.png"
                  alt="The Last Supper"
                  className="rounded-2xl shadow-lg object-cover w-full h-48 md:h-64 transform transition-transform duration-500 hover:scale-105"
                />
              </div>

              <div className="flex flex-col justify-center text-white">
                <h1 className="text-4xl md:text-5xl font-extrabold bg-gradient-to-r from-secondary-200 via-secondary-400 to-secondary-300 bg-clip-text text-transparent">
                  Leonardo Da Vinci
                </h1>
                <p className="mt-4 text-lg leading-relaxed text-gray-100">
                  A Renaissance artist, inventor, and scientist who is regarded
                  as one of the greatest minds in human history.
                </p>
                <div className="mt-6 grid grid-cols-2 gap-6 text-sm">
                  <div>
                    <p className="text-gray-300">Born</p>
                    <p className="font-bold">April 15, 1452</p>
                  </div>
                  <div>
                    <p className="text-gray-300">Died</p>
                    <p className="font-bold">May 2, 1519</p>
                  </div>
                </div>
                <a
                  href="#paintings"
                  className="mt-8 inline-block px-6 py-3 rounded-full font-semibold bg-gradient-to-r from-secondary-200 to-secondary-400 text-gray-900 shadow-md hover:shadow-xl transform transition-transform duration-300 hover:scale-105"
                >
                  See Paintings
                </a>
              </div>
            </div>
          </SwiperSlide>

          {/* Slide 2 (contoh, bisa ditambah lagi) */}
          <SwiperSlide>
            <div className="bg-primary-200/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8 md:p-12 grid md:grid-cols-2 gap-8 border border-white/20">
              <div className="grid grid-cols-2 gap-4">
                <img
                  src="/illustrasi/wayang.png"
                  alt="Another Artwork"
                  className="rounded-2xl shadow-lg object-cover w-full h-48 md:h-64"
                />
                <img
                  src="/illustrasi/wayang.png"
                  alt="Artwork"
                  className="rounded-2xl shadow-lg object-cover w-full h-48 md:h-64"
                />
              </div>
              <div className="flex flex-col justify-center text-white">
                <h1 className="text-4xl md:text-5xl font-extrabold bg-gradient-to-r from-secondary-300 to-secondary-500 bg-clip-text text-transparent">
                  Another Tokoh
                </h1>
                <p className="mt-4 text-lg leading-relaxed text-gray-100">
                  Deskripsi singkat tokoh lain bisa ditaruh di sini.
                </p>
              </div>
            </div>
          </SwiperSlide>
        </Swiper>

        {/* Custom Navigation Buttons */}
        <button className="custom-prev absolute left-4 top-1/2 -translate-y-1/2 bg-secondary-200 text-white p-3 rounded-full shadow-lg hover:bg-secondary-300 transition">
          <FontAwesomeIcon icon={faArrowLeft} size="lg" />
        </button>
        <button className="custom-next absolute right-4 top-1/2 -translate-y-1/2 bg-secondary-200 text-white p-3 rounded-full shadow-lg hover:bg-secondary-300 transition">
          <FontAwesomeIcon icon={faArrowRight} size="lg" />
        </button>
      </div>
    </section>
  );
}
