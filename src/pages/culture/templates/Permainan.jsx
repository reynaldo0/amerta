import React, { useRef } from "react";
import { Swiper, SwiperSlide } from "swiper/react";
import "swiper/css";
import "swiper/css/navigation";
import { Navigation } from "swiper/modules";

const gameCultureData = [
  {
    title: "Congklak",
    subtitle: "Permainan Tradisional",
    description:
      "Permainan papan tradisional yang mengasah strategi dan kesabaran.",
    image: "/illustrasi/congklak.jpg",
    pdfLink: "/pdf/congklak.pdf",
  },
  {
    title: "Gasing",
    subtitle: "Permainan Fisik",
    description:
      "Permainan memutar gasing yang menantang ketangkasan dan koordinasi.",
    image: "/illustrasi/gasing.jpg",
    pdfLink: "/pdf/gasing.pdf",
  },
  {
    title: "Engklek",
    subtitle: "Permainan Anak",
    description: "Permainan melompat pada kotak-kotak yang digambar di tanah.",
    image: "/illustrasi/engkle.jpg",
    pdfLink: "/pdf/engkle.pdf",
  },
  {
    title: "Engklek",
    subtitle: "Permainan Anak",
    description: "Permainan melompat pada kotak-kotak yang digambar di tanah.",
    image: "/illustrasi/engkle.jpg",
    pdfLink: "/pdf/engkle.pdf",
  },
];

export default function SectionGameCultureSlider() {
  const prevRef = useRef(null);
  const nextRef = useRef(null);

  return (
    <section className="py-24 bg-primary-100 relative">
      <div className="max-w-7xl mx-auto px-6 lg:px-16">
        <h2 className="text-4xl md:text-5xl font-extrabold text-white text-center mb-12">
          Budaya Permainan
        </h2>

        {/* Slider with navigation buttons */}
        <div className="relative">
          <Swiper
            modules={[Navigation]}
            spaceBetween={40}
            slidesPerView={1.2}
            breakpoints={{
              768: { slidesPerView: 2.2 },
              1024: { slidesPerView: 3.2 },
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
            {gameCultureData.map((item, idx) => (
              <SwiperSlide key={idx}>
                <div className="relative p-5 group flex flex-col items-center">
                  {/* Floating Image */}
                  <div className="w-48 h-48 rounded-2xl overflow-hidden shadow-2xl mb-[-2rem] transition-transform duration-500 group-hover:scale-110 group-hover:rotate-2">
                    <img
                      src={item.image}
                      alt={item.title}
                      className="w-full h-full object-cover"
                    />
                  </div>

                  {/* Card */}
                  <div className="bg-white/20 backdrop-blur-xl rounded-3xl p-6 pt-24 w-full flex flex-col items-center shadow-lg transform transition-transform duration-500 group-hover:scale-105 group-hover:rotate-1">
                    <h3 className="text-2xl font-bold text-white mb-1 text-center">
                      {item.title}
                    </h3>
                    <h4 className="text-lg text-secondary-300 mb-3 text-center">
                      {item.subtitle}
                    </h4>
                    <p className="text-white/90 mb-4 text-center">
                      {item.description}
                    </p>
                    <a
                      href={item.pdfLink}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="bg-secondary-300 px-4 py-2 rounded-full font-semibold text-white shadow-lg hover:scale-110 hover:shadow-2xl transition-all"
                    >
                      Lihat PDF
                    </a>
                  </div>
                </div>
              </SwiperSlide>
            ))}
          </Swiper>

          {/* Navigation Buttons */}
          <button
            ref={prevRef}
            className="absolute top-1/2 -left-6 -translate-y-1/2 bg-white/20 backdrop-blur-lg text-white w-10 h-10 rounded-full flex items-center justify-center shadow-lg hover:bg-white/30 transition"
          >
            &#8592;
          </button>
          <button
            ref={nextRef}
            className="absolute top-1/2 -right-6 -translate-y-1/2 bg-white/20 backdrop-blur-lg text-white w-10 h-10 rounded-full flex items-center justify-center shadow-lg hover:bg-white/30 transition"
          >
            &#8594;
          </button>
        </div>
      </div>
    </section>
  );
}
