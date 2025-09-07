import React, { useRef, useState } from "react";
import { Swiper, SwiperSlide } from "swiper/react";
import { Navigation } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
  faChevronLeft,
  faChevronRight,
  faDownload,
} from "@fortawesome/free-solid-svg-icons";
import { useLocation } from "react-router-dom";
import { tariData } from "../../../docs/tariData";

export default function TariSectionMobile() {
  const swiperRef = useRef(null);
  const [isBeginning, setIsBeginning] = useState(true);
  const [isEnd, setIsEnd] = useState(false);

  const location = useLocation();
  const path = location.pathname.replace("/budaya-", "");
  const posts = tariData[path] || tariData.jawa;

  return (
    <section className="relative w-full min-h-screen bg-white overflow-hidden">
      <div
        className="absolute inset-0 bg-[url('/wave/budaya.png')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />
      <img
        src="/wave/form.png"
        alt="Wave"
        className="w-full h-full object-cover will-change-transform"
      />
      <div className="absolute top-0 w-full overflow-hidden leading-[0] z-20 will-change-transform"></div>
      <div className="max-w-7xl mx-auto px-6 lg:px-16 z-10 py-20">
        {/* Title */}
        <h1 className="text-4xl md:text-5xl font-extrabold text-white text-center mb-4">
          Budaya <span className="text-secondary-300">Tari</span>{" "}
          {path.charAt(0).toUpperCase() + path.slice(1)}
        </h1>
        <p className="text-center text-white/80 text-base md:text-lg mb-12 max-w-3xl mx-auto">
          Jelajahi tarian tradisional dari pulau {path}. Setiap gerakan
          menyimpan cerita dan filosofi budaya yang unik.
        </p>

        {/* Slider */}
        <div className="relative">
          <Swiper
            modules={[Navigation]}
            spaceBetween={20}
            slidesPerView={1.1}
            breakpoints={{
              640: { slidesPerView: 1.2 },
              768: { slidesPerView: 2.2 },
              1024: { slidesPerView: 3 },
            }}
            onSwiper={(swiper) => {
              swiperRef.current = swiper;
              setIsBeginning(swiper.isBeginning);
              setIsEnd(swiper.isEnd);
            }}
            onSlideChange={(swiper) => {
              setIsBeginning(swiper.isBeginning);
              setIsEnd(swiper.isEnd);
            }}
          >
            {posts.map((post, idx) => (
              <SwiperSlide key={idx}>
                <div className="group relative rounded-2xl overflow-hidden shadow-lg bg-white transition-transform duration-300 hover:scale-105 active:scale-100">
                  <div className="relative h-56 md:h-64 overflow-hidden rounded-t-2xl">
                    <img
                      src={post.image}
                      alt={post.title}
                      className="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-105"
                    />
                  </div>
                  <div className="p-4 md:p-5 flex flex-col">
                    <p className="text-xs md:text-sm text-secondary-300 font-semibold mb-1">
                      {post.subtitle}
                    </p>
                    <h3 className="text-lg md:text-xl font-bold text-gray-900 mb-2">
                      {post.title}
                    </h3>
                    <p className="text-gray-700 text-sm mb-3 flex-grow">
                      {post.description}
                    </p>
                    <a
                      href={post.pdf}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="inline-flex items-center gap-2 text-secondary-300 font-semibold hover:text-secondary-400 transition text-sm md:text-base"
                    >
                      <FontAwesomeIcon icon={faDownload} />
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
              onClick={() => swiperRef.current?.slidePrev()}
              disabled={isBeginning}
              className={`w-12 h-12 rounded-full bg-white text-gray-800 shadow-lg flex items-center justify-center hover:bg-secondary-300 hover:text-white transition ${
                isBeginning ? "opacity-40 cursor-not-allowed" : ""
              }`}
            >
              <FontAwesomeIcon icon={faChevronLeft} />
            </button>
            <button
              onClick={() => swiperRef.current?.slideNext()}
              disabled={isEnd}
              className={`w-12 h-12 rounded-full bg-white text-gray-800 shadow-lg flex items-center justify-center hover:bg-secondary-300 hover:text-white transition ${
                isEnd ? "opacity-40 cursor-not-allowed" : ""
              }`}
            >
              <FontAwesomeIcon icon={faChevronRight} />
            </button>
          </div>

          {/* Desktop Buttons */}
          <button
            onClick={() => swiperRef.current?.slidePrev()}
            disabled={isBeginning}
            className={`hidden md:flex absolute top-1/2 -left-20 transform -translate-y-1/2 w-14 h-14 rounded-full bg-white text-gray-800 shadow-xl items-center justify-center hover:bg-secondary-300 hover:text-white transition ${
              isBeginning ? "opacity-40 cursor-not-allowed" : ""
            }`}
          >
            <FontAwesomeIcon icon={faChevronLeft} size="lg" />
          </button>
          <button
            onClick={() => swiperRef.current?.slideNext()}
            disabled={isEnd}
            className={`hidden md:flex absolute top-1/2 -right-20 transform -translate-y-1/2 w-14 h-14 rounded-full bg-white text-gray-800 shadow-xl items-center justify-center hover:bg-secondary-300 hover:text-white transition ${
              isEnd ? "opacity-40 cursor-not-allowed" : ""
            }`}
          >
            <FontAwesomeIcon icon={faChevronRight} size="lg" />
          </button>
        </div>
      </div>
    </section>
  );
}
