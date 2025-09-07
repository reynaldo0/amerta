import React, { useRef } from "react";
import { Swiper, SwiperSlide } from "swiper/react";
import "swiper/css";
import "swiper/css/navigation";
import { Navigation } from "swiper/modules";
import { useLocation } from "react-router-dom";
import { permainanData as data } from "../../../docs/permainanData";

export default function SectionGameCultureMobile() {
  const prevRef = useRef(null);
  const nextRef = useRef(null);

  const location = useLocation();
  const path = location.pathname.replace("/budaya-", "");
  const permainanData = data[path] || data.jawa;

  return (
    <section className="min-h-screen bg-primary-100 relative py-24">
      <div
        className="absolute inset-0 bg-[url('/wave/budaya.png')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />
      <div className="max-w-7xl mx-auto px-6 lg:px-16 z-10">
        <h2 className="text-4xl md:text-5xl font-extrabold text-white text-center mb-12">
          Budaya Permainan {path.charAt(0).toUpperCase() + path.slice(1)}
        </h2>

        <div className="relative">
          <Swiper
            modules={[Navigation]}
            spaceBetween={20}
            slidesPerView={1.1} // mobile peek
            breakpoints={{
              640: { slidesPerView: 1.2 },
              768: { slidesPerView: 2.2 },
              1024: { slidesPerView: 3 },
            }}
            navigation={{
              prevEl: prevRef.current,
              nextEl: nextRef.current,
            }}
            onBeforeInit={(swiper) => {
              swiper.params.navigation.prevEl = prevRef.current;
              swiper.params.navigation.nextEl = nextRef.current;
            }}
          >
            {permainanData.map((item, idx) => (
              <SwiperSlide key={idx}>
                <div className="group relative rounded-2xl overflow-hidden shadow-lg bg-white transition-transform duration-300 hover:scale-105">
                  <div className="relative h-56 md:h-64 overflow-hidden rounded-t-2xl">
                    <img
                      src={item.image}
                      alt={item.title}
                      className="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-105"
                    />
                  </div>
                  <div className="p-4 md:p-5 flex flex-col items-center">
                    <h3 className="text-xl font-bold text-gray-900 mb-1 text-center">
                      {item.title}
                    </h3>
                    <h4 className="text-sm text-secondary-300 mb-2 text-center">
                      {item.subtitle}
                    </h4>
                    <p className="text-gray-700 text-sm mb-4 text-justify">
                      {item.description}
                    </p>
                    <a
                      href={item.pdfLink}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="inline-flex
                      bg-secondary-300 rounded-3xl px-5 py-3 items-center gap-2 text-white font-semibold hover:text-secondary-400 transition"
                    >
                      Lihat PDF
                    </a>
                  </div>
                </div>
              </SwiperSlide>
            ))}
          </Swiper>

          {/* Mobile Navigation Buttons */}
          <div className="flex justify-center gap-6 mt-6 md:hidden">
            <button
              ref={prevRef}
              className="w-12 h-12 rounded-full bg-white text-gray-800 shadow-lg flex items-center justify-center hover:bg-secondary-300 hover:text-white transition"
            >
              &#8592;
            </button>
            <button
              ref={nextRef}
              className="w-12 h-12 rounded-full bg-white text-gray-800 shadow-lg flex items-center justify-center hover:bg-secondary-300 hover:text-white transition"
            >
              &#8594;
            </button>
          </div>

          {/* Desktop Buttons */}
          <button
            ref={prevRef}
            className="hidden md:flex absolute top-1/2 -left-16 transform -translate-y-1/2 w-14 h-14 rounded-full bg-white text-gray-800 shadow-xl items-center justify-center hover:bg-secondary-300 hover:text-white transition"
          >
            &#8592;
          </button>
          <button
            ref={nextRef}
            className="hidden md:flex absolute top-1/2 -right-16 transform -translate-y-1/2 w-14 h-14 rounded-full bg-white text-gray-800 shadow-xl items-center justify-center hover:bg-secondary-300 hover:text-white transition"
          >
            &#8594;
          </button>
        </div>
      </div>
    </section>
  );
}
