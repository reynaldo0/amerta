import React, { useEffect, useState } from "react";
import axios from "axios";
import { Swiper, SwiperSlide } from "swiper/react";
import { Navigation } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
  faArrowLeft,
  faArrowRight,
  faArrowUpRightFromSquare,
} from "@fortawesome/free-solid-svg-icons";

export default function PinterestBlogModern() {
  const [items, setItems] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchItems = async () => {
      try {
        const res = await axios.get("http://127.0.0.1:8000/api/v1/items");
        // Pastikan API mengembalikan array items
        setItems(res.data.items || []);
      } catch (err) {
        console.error("Gagal fetch data:", err);
      } finally {
        setLoading(false);
      }
    };
    fetchItems();
  }, []);

  if (loading) {
    return (
      <div className="flex items-center justify-center min-h-[200px]">
        <p className="text-gray-600">Loading data...</p>
      </div>
    );
  }

  return (
    <section className="relative w-full bg-gray-50 py-16 px-6 md:px-16">
      <div className="max-w-7xl mx-auto flex flex-col md:flex-row gap-12">
        {/* Left Section */}
        <div className="md:w-1/3 flex flex-col justify-between">
          <div>
            <h2 className="text-4xl md:text-5xl font-extrabold mb-4 text-gray-900 animate-fade-in-down">
              Koleksi Budaya
            </h2>
            <p className="text-gray-600 mb-6">
              Jelajahi budaya keseharian, kebiasaan, serta tari dari seluruh
              provinsi di Indonesia.
            </p>
            <button className="bg-secondary-300 text-white px-6 py-3 rounded-full font-semibold hover:bg-secondary-400 transition shadow-md hover:shadow-xl">
              Lihat semua koleksi
            </button>
          </div>

          {/* Navigation buttons */}
          <div className="flex items-center gap-6 mt-10">
            <button className="swiper-button-prev-custom w-12 h-12 rounded-full bg-white shadow-lg hover:bg-secondary-300 flex items-center justify-center text-gray-600 hover:text-white transition">
              <FontAwesomeIcon icon={faArrowLeft} size="lg" />
            </button>
            <button className="swiper-button-next-custom w-12 h-12 rounded-full bg-white shadow-lg hover:bg-secondary-300 flex items-center justify-center text-gray-600 hover:text-white transition">
              <FontAwesomeIcon icon={faArrowRight} size="lg" />
            </button>
          </div>
        </div>

        {/* Right Section - Swiper */}
        <div className="md:w-2/3">
          <Swiper
            modules={[Navigation]}
            navigation={{
              prevEl: ".swiper-button-prev-custom",
              nextEl: ".swiper-button-next-custom",
            }}
            spaceBetween={20}
            slidesPerView={1}
            breakpoints={{ 768: { slidesPerView: 2 } }}
          >
            {items.map((item, index) => (
              <SwiperSlide key={index}>
                <div className="bg-white m-5 rounded-3xl shadow-xl hover:shadow-2xl overflow-hidden flex flex-col h-full transition-transform duration-500 hover:scale-105">
                  <div className="relative w-full h-56 md:h-64">
                    {item.file_url && (
                      <img
                        src={`http://localhost:8000${item.file_url}`} 
                        alt={item.title}
                        className="w-full h-full object-cover"
                      />
                    )}
                    <div className="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                  </div>
                  <div className="p-6 flex flex-col flex-grow">
                    <p className="text-sm text-gray-500 mb-1">
                      {item.category}
                    </p>
                    <h3 className="text-lg md:text-xl font-bold text-gray-900">
                      {item.title}
                    </h3>
                    <p className="text-gray-700 text-sm mt-2 flex-grow">
                      {item.description}
                    </p>
                    {item.file_url && (
                      <a
                        href={item.file_url}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="mt-4 inline-flex items-center gap-2 font-semibold text-secondary-300 hover:text-secondary-400 transition"
                      >
                        <FontAwesomeIcon
                          icon={faArrowUpRightFromSquare}
                          className="w-4 h-4"
                        />
                        Lihat File
                      </a>
                    )}
                  </div>
                </div>
              </SwiperSlide>
            ))}
          </Swiper>
        </div>
      </div>

      {/* Animations */}
      <style>{`
        @keyframes fadeInDown {0%{opacity:0; transform:translateY(-20px);}100%{opacity:1; transform:translateY(0);}}
        .animate-fade-in-down {animation: fadeInDown 1s ease-out forwards;}
      `}</style>
    </section>
  );
}
