import React, { useRef, useState } from "react";
import { Swiper, SwiperSlide } from "swiper/react";
import { Navigation } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";

// Import FontAwesome
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
  faChevronLeft,
  faChevronRight,
  faDownload,
} from "@fortawesome/free-solid-svg-icons";

const posts = [
  {
    date: "Rabu, 30 Oktober 2024",
    title: "Festival Kuliner Tradisional",
    description:
      "Jelajahi kelezatan kuliner khas Sumatera yang diwariskan turun-temurun, penuh makna budaya.",
    image: "/images/kuliner.jpg",
    pdf: "/pdf/kuliner.pdf",
  },
  {
    date: "Jumat, 04 Oktober 2024",
    title: "Warisan Tari Tradisional",
    description:
      "Tarian indah yang menggambarkan cerita rakyat, perayaan, serta identitas masyarakat.",
    image: "/images/tarian.jpg",
    pdf: "/pdf/tarian.pdf",
  },
  {
    date: "Senin, 16 September 2024",
    title: "Permainan Rakyat",
    description:
      "Permainan tradisional yang mempererat persaudaraan, diwariskan dari generasi ke generasi.",
    image: "/images/permainan.jpg",
    pdf: "/pdf/permainan.pdf",
  },
];

export default function CultureHighlights() {
  const swiperRef = useRef(null);
  const [isBeginning, setIsBeginning] = useState(true);
  const [isEnd, setIsEnd] = useState(false);

  return (
    <section className="relative w-full min-h-screen py-28 bg-white overflow-hidden">
      <div
        className="absolute inset-0 bg-[url('/wave/budaya.png')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />
      {/* Floating Ornaments */}
      <div className="absolute top-10 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-pulse"></div>

      <div className="relative max-w-7xl mx-auto px-6 lg:px-16 z-10 grid lg:grid-cols-2 gap-16 items-center">
        {/* Left Side - Text */}
        <div className="text-center lg:text-left">
          <h2 className="text-4xl md:text-6xl font-extrabold text-primary-900 leading-tight">
            Sorotan <span className="text-secondary-300">Budaya</span> Nusantara
          </h2>
          <p className="mt-6 text-lg md:text-xl text-primary-700 max-w-xl mx-auto lg:mx-0">
            Menyelami kisah, kuliner, tarian, dan permainan rakyat yang menjadi
            warisan budaya berharga. Temukan keunikan tiap tradisi yang penuh
            makna.
          </p>

          {/* Manual Controls */}
          <div className="flex justify-center lg:justify-start gap-4 mt-8">
            <button
              onClick={() => swiperRef.current?.slidePrev()}
              disabled={isBeginning}
              className={`flex items-center px-4 py-3 rounded-full font-semibold shadow-md transition ${
                isBeginning
                  ? "bg-gray-300 text-gray-600 cursor-not-allowed"
                  : "bg-secondary-200 text-white hover:bg-secondary-300 hover:scale-105"
              }`}
            >
              <FontAwesomeIcon icon={faChevronLeft} />
              <span className="hidden lg:inline ml-2">Sebelumnya</span>
            </button>
            <button
              onClick={() => swiperRef.current?.slideNext()}
              disabled={isEnd}
              className={`flex items-center px-4 py-3 rounded-full font-semibold shadow-md transition ${
                isEnd
                  ? "bg-gray-300 text-gray-600 cursor-not-allowed"
                  : "bg-secondary-200 text-white hover:bg-secondary-300 hover:scale-105"
              }`}
            >
              <span className="hidden lg:inline mr-2">Selanjutnya</span>
              <FontAwesomeIcon icon={faChevronRight} />
            </button>
          </div>
        </div>

        {/* Right Side - Swiper Cards */}
        <Swiper
          modules={[Navigation]}
          spaceBetween={20}
          slidesPerView={1}
          onSwiper={(swiper) => {
            swiperRef.current = swiper;
            setIsBeginning(swiper.isBeginning);
            setIsEnd(swiper.isEnd);
          }}
          onSlideChange={(swiper) => {
            setIsBeginning(swiper.isBeginning);
            setIsEnd(swiper.isEnd);
          }}
          className="w-full"
        >
          {posts.map((post, idx) => (
            <SwiperSlide key={idx}>
              <div className="relative m-5 rounded-3xl overflow-hidden shadow-xl bg-white/40 backdrop-blur-xl border border-white/20 hover:scale-105 hover:shadow-2xl transition-transform duration-500 group">
                {/* Image */}
                <div className="relative h-48 w-full overflow-hidden">
                  <img
                    src={post.image}
                    alt={post.title}
                    className="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                  />
                  <div className="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                </div>

                {/* Content */}
                <div className="p-6">
                  <p className="text-sm text-secondary-300 font-medium mb-2">
                    {post.date}
                  </p>
                  <h3 className="text-xl font-bold text-primary-900 mb-3 group-hover:text-secondary-300 transition-colors">
                    {post.title}
                  </h3>
                  <p className="text-primary-700 text-sm mb-4">
                    {post.description}
                  </p>

                  {/* Action Buttons */}
                  <div className="flex justify-between items-center">
                    <button className="text-sm font-semibold text-secondary-300 group-hover:underline">
                      Baca Selengkapnya →
                    </button>
                    <a
                      href={post.pdf}
                      download
                      className="p-3 rounded-full bg-secondary-200 text-white hover:bg-secondary-300 transition"
                    >
                      <FontAwesomeIcon icon={faDownload} />
                    </a>
                  </div>
                </div>
              </div>
            </SwiperSlide>
          ))}
        </Swiper>
      </div>
    </section>
  );
}
