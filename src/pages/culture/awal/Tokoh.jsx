import React from "react";
import { Swiper, SwiperSlide } from "swiper/react";
import "swiper/css";
import "swiper/css/navigation";
import { Navigation } from "swiper/modules";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faArrowLeft, faArrowRight } from "@fortawesome/free-solid-svg-icons";

export default function Tokoh() {
  const tokohData = [
    {
      name: "Yuli Astuti",
      description:
        "Yuli Astuti adalah seorang pengusaha batik tulis dari Kudus yang berkomitmen untuk melestarikan warisan budaya batik tulis Indonesia. Dia mendirikan Muria Batik Kudus dengan tujuan menjaga keaslian batik tulis sebagai bagian dari identitas budaya lokal.",
      born: "15 Desember 1978",
      died: "2005",
      images: ["/tokoh/yuli.png", "/tokoh/yuli2.png"],
      gradient: "from-secondary-200 via-secondary-400 to-secondary-300",
    },
    {
      name: "Gusti Kanjeng Ratu Hemas",
      description:
        " Tokoh perempuan yang berjasa besar dalam melestarikan batik Yogyakarta. Beliau tidak hanya mempromosikan batik sebagai warisan budaya Indonesia, tetapi juga berperan aktif dalam pengembangan dan inovasi desain batik modern.",
      born: "15 Desember 1978",
      died: "2002",
      images: ["/tokoh/gusti.png", "/tokoh/gusti2.png"],
      gradient: "from-secondary-200 via-secondary-400 to-secondary-300",
    },
    {
      name: "Ida Royani",
      description:
        "Ida Royani adalah seorang seniman tari Indonesia yang dikenal sebagai “Ratu Tari Bali”. Ia telah menyumbangkan bakatnya dalam mempertahankan dan mengembangkan seni tari Bali baik di dalam maupun luar negeri.",
      born: "24 Maret 1953",
      died: "1960-an",
      images: ["/tokoh/ida.png", "/tokoh/ida2.png"],
      gradient: "from-secondary-200 via-secondary-400 to-secondary-300",
    },
    {
      name: "Emha Ainun Nadjib",
      description:
        "Emha Ainun Nadjib atau yang lebih dikenal dengan nama Cak Nun, adalah seorang budayawan yang terkenal dengan karya-karyanya dalam bidang sastra dan musik tradisional Jawa. Ia juga sering memberikan ceramah dan pidato mengenai nilai-nilai budaya Indonesia.",
      born: "27 Mei 1953",
      died: "1977",
      images: ["/tokoh/emha.png", "/tokoh/emha2.png"],
      gradient: "from-secondary-200 via-secondary-400 to-secondary-300",
    },
    {
      name: "Eko Supriyanto",
      description:
        'Eko Supriyanto telah menciptakan berbagai pertunjukan tari kontemporer yang mendapatkan pengakuan internasional, seperti "Tari Bumi" yang menggambarkan hubungan antara manusia dengan alam. Ia juga aktif dalam mendidik generasi muda tentang tari kontemporer melalui workshop-wokshop serta program pelatihan tari di berbagai institusi seni.',
      born: "26 November 1970",
      died: "2002",
      images: ["/tokoh/eko.png", "/tokoh/eko2.png"],
      gradient: "from-secondary-200 via-secondary-400 to-secondary-300",
    },
  ];

  // daftar animasi AOS
  const animations = [
    "fade-up",
    "fade-down",
    "zoom-in",
    "flip-left",
    "flip-right",
  ];

  return (
    <section className="relative w-full min-h-screen text-white overflow-hidden">
      <img
        src="/wave/tokoh.png"
        alt="Wave"
        className="w-full h-full object-cover will-change-transform"
      />
      <div
        className="absolute inset-0 bg-[url('/wave/budaya.png')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />
      <h2
        className="text-4xl md:text-5xl font-extrabold text-center text-primary-200 tracking-tight"
        data-aos="fade-down"
      >
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
          {tokohData.map((tokoh, index) => (
            <SwiperSlide key={index}>
              <div
                className="bg-primary-200/90 rounded-3xl shadow-2xl p-8 md:p-12 grid md:grid-cols-2 gap-8 border border-white/20"
                data-aos={animations[index % animations.length]}
                data-aos-duration="1200"
                data-aos-once="true"
              >
                {/* Gambar tokoh */}
                <div className="grid grid-cols-2 gap-4">
                  {tokoh.images.map((img, idx) => (
                    <img
                      key={idx}
                      src={img}
                      alt={tokoh.name + idx}
                      data-aos="zoom-in"
                      data-aos-delay={idx * 200}
                      className="rounded-2xl shadow-lg object-cover w-full h-48 md:h-64 transform transition-transform duration-500 hover:scale-105"
                    />
                  ))}
                </div>

                {/* Info tokoh */}
                <div
                  className="flex flex-col justify-center text-white"
                  data-aos="fade-up"
                  data-aos-delay="400"
                >
                  <h1
                    className={`text-4xl md:text-5xl font-extrabold bg-gradient-to-r ${tokoh.gradient} bg-clip-text text-transparent`}
                  >
                    {tokoh.name}
                  </h1>
                  <p className="mt-4 text-lg leading-relaxed text-gray-100">
                    {tokoh.description}
                  </p>

                  {tokoh.born && tokoh.died && (
                    <div className="mt-6 grid grid-cols-2 gap-6 text-sm">
                      <div data-aos="fade-right">
                        <p className="text-gray-300">Lahir pada Tanggal</p>
                        <p className="font-bold">{tokoh.born}</p>
                      </div>
                      <div data-aos="fade-left">
                        <p className="text-gray-300">
                          Memulai Karir Pada Tahun
                        </p>
                        <p className="font-bold">{tokoh.died}</p>
                      </div>
                    </div>
                  )}
                </div>
              </div>
            </SwiperSlide>
          ))}
        </Swiper>

        {/* Custom Navigation Buttons */}
        <button
          className="custom-prev absolute left-4 top-[35%] md:top-1/2 -translate-y-1/2 bg-secondary-200 text-white p-3 rounded-full shadow-lg hover:bg-secondary-300 transition z-[9999999]"
          data-aos="fade-right"
        >
          <FontAwesomeIcon icon={faArrowLeft} size="lg" />
        </button>
        <button
          className="custom-next absolute right-4 top-[35%] md:top-1/2 -translate-y-1/2 bg-secondary-200 text-white p-3 rounded-full shadow-lg hover:bg-secondary-300 transition z-[9999999]"
          data-aos="fade-left"
        >
          <FontAwesomeIcon icon={faArrowRight} size="lg" />
        </button>
      </div>
    </section>
  );
}
