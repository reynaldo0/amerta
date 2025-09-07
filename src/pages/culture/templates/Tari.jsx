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

export default function TariSectionClean() {
  const swiperRef = useRef(null);
  const [isBeginning, setIsBeginning] = useState(true);
  const [isEnd, setIsEnd] = useState(false);

  const location = useLocation();
  const path = location.pathname.replace("/budaya-", "");
  const posts = tariData[path] || tariData.jawa;

  return (
    <section className="relative w-full min-h-screen py-32 bg-gradient-to-b from-primary-900 to-primary-800 overflow-hidden">
      {/* Main Content */}
      <div className="max-w-7xl mx-auto px-6 lg:px-16 z-10">
        {/* Title */}
        <h1 className="text-5xl md:text-6xl font-extrabold text-white text-center mb-6">
          Budaya <span className="text-secondary-300">Tari</span>{" "}
          {path.charAt(0).toUpperCase() + path.slice(1)}
        </h1>
        <p className="text-center text-white/80 text-lg md:text-xl mb-16 max-w-3xl mx-auto">
          Jelajahi tarian tradisional dari pulau {path}. Setiap gerakan
          menyimpan cerita dan filosofi budaya yang unik.
        </p>

        {/* Slider + Controls */}
        <div className="flex flex-col lg:flex-row items-center gap-12">
          {/* Navigation Buttons */}
          <div className="flex flex-row lg:flex-col gap-4 justify-center lg:justify-start">
            <button
              onClick={() => swiperRef.current?.slidePrev()}
              disabled={isBeginning}
              className={`flex items-center justify-center w-12 h-12 rounded-full bg-white text-gray-800 shadow-md hover:bg-secondary-300 hover:text-white transition ${
                isBeginning ? "opacity-40 cursor-not-allowed" : ""
              }`}
            >
              <FontAwesomeIcon icon={faChevronLeft} />
            </button>
            <button
              onClick={() => swiperRef.current?.slideNext()}
              disabled={isEnd}
              className={`flex items-center justify-center w-12 h-12 rounded-full bg-white text-gray-800 shadow-md hover:bg-secondary-300 hover:text-white transition ${
                isEnd ? "opacity-40 cursor-not-allowed" : ""
              }`}
            >
              <FontAwesomeIcon icon={faChevronRight} />
            </button>
          </div>

          {/* Swiper Cards */}
          <Swiper
            modules={[Navigation]}
            spaceBetween={30}
            slidesPerView={1.1}
            breakpoints={{
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
                <div className="group relative rounded-2xl overflow-hidden shadow-lg bg-white hover:shadow-2xl transition-transform duration-300 hover:scale-105">
                  {/* Image */}
                  <div className="relative h-64 overflow-hidden rounded-t-2xl">
                    <img
                      src={post.image}
                      alt={post.title}
                      className="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-105"
                    />
                  </div>

                  {/* Content */}
                  <div className="p-5 flex flex-col">
                    <p className="text-sm text-secondary-300 font-semibold mb-1">
                      {post.subtitle}
                    </p>
                    <h3 className="text-xl font-bold text-gray-900 mb-2">
                      {post.title}
                    </h3>
                    <p className="text-gray-700 text-sm mb-4 flex-grow">
                      {post.description}
                    </p>

                    {/* PDF */}
                    <a
                      href={post.pdf}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="inline-flex items-center gap-2 text-secondary-300 font-semibold hover:text-secondary-400 transition"
                    >
                      <FontAwesomeIcon icon={faDownload} />
                      Lihat PDF
                    </a>
                  </div>
                </div>
              </SwiperSlide>
            ))}
          </Swiper>
        </div>
      </div>
    </section>
  );
}
