import React, { useRef } from "react";
import { Link } from "react-router-dom";

const islands = [
  {
    name: "Pulau Jawa",
    description:
      "Salah satu pulau terbesar di Indonesia dan merupakan pusat kehidupan sosial, ekonomi, dan budaya. Pulau memiliki populasi sekitar 56% dari total penduduk Indonesia. Pulau Jawa terletak di Kepulauan Sunda Besar dan dikelilingi oleh beberapa pulau besar.",
    image: "/illustrasi/budaya/peta/jawa.png",
    url: "/budaya-jawa",
  },
  {
    name: "Pulau Sumatera",
    description:
      "Pulau dengan kekayaan budaya Aceh, Minangkabau, Batak, dan Melayu. Sumatera juga dikenal dengan keindahan alamnya yang luas.",
    image: "/illustrasi/budaya/peta/sumatera.png",
    url: "/budaya-sumatera",
  },
  {
    name: "Pulau Kalimantan",
    description:
      "Budaya Dayak dengan rumah panjang, tarian tradisional, dan kekayaan hutan tropis terbesar di Indonesia.",
    image: "/illustrasi/budaya/peta/kalimantan.png",
    url: "/budaya-kalimantan",
  },
  {
    name: "Pulau Sulawesi",
    description:
      "Budaya Toraja, Minahasa, Bugis, dan Mandar yang penuh warna serta keindahan lautnya yang mendunia.",
    image: "/illustrasi/budaya/peta/sulawesi.png",
    url: "/budaya-sulawesi",
  },
  {
    name: "Pulau Papua",
    description:
      "Tradisi suku Dani, Asmat, serta kekayaan seni ukir dan tari khas Papua yang mendalam.",
    image: "/illustrasi/budaya/peta/papua.png",
    url: "/budaya-papua",
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

function TiltCard({ island, animation }) {
  const cardRef = useRef(null);

  const handleMouseMove = (e) => {
    const card = cardRef.current;
    const rect = card.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    const rotateY = (x / rect.width - 0.5) * 20;
    const rotateX = (y / rect.height - 0.5) * -20;
    card.style.transform = `perspective(800px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.03)`;
  };

  const handleMouseLeave = () => {
    const card = cardRef.current;
    card.style.transform =
      "perspective(800px) rotateX(0deg) rotateY(0deg) scale(1)";
  };

  return (
    <div
      ref={cardRef}
      data-aos={animation} // animasi unik tiap card
      data-aos-duration="1200"
      data-aos-once="true"
      onMouseMove={handleMouseMove}
      onMouseLeave={handleMouseLeave}
      className="relative group p-6 bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden transition-transform duration-300"
    >
      {/* Background Image */}
      <div className="absolute inset-0 flex items-center justify-center pointer-events-none">
        <img
          src={island.image}
          alt={island.name}
          className="w-3/4 opacity-20 group-hover:opacity-20 transition duration-500 object-contain"
        />
      </div>

      {/* Content */}
      <div className="relative z-10">
        <h3 className="text-xl font-extrabold tracking-wide text-primary-100 mb-3 group-hover:text-primary-300 transition-colors duration-300">
          {island.name}
        </h3>
        <p className="text-sm text-primary-100 group-hover:text-primary-300 mb-4">
          {island.description}
        </p>
        <Link
          to={island.url}
          className="inline-block text-secondary-200 font-semibold transition-all duration-300 group-hover:text-secondary-300 group-hover:translate-x-2"
        >
          Selengkapnya →
        </Link>
      </div>
    </div>
  );
}

export default function Budaya() {
  return (
    <section id="pulau" className="bg-primary-100 relative min-h-screen pb-20">
      <img
        src="/wave/map2.png"
        alt="Wave"
        className="w-full h-full object-cover will-change-transform"
      />
      {/* Background Parallax */}
      <div
        className="absolute inset-0 bg-[url('/wave/budayaw.png')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />
      <div className="max-w-7xl mx-5 md:mx-auto grid md:grid-cols-2 gap-12 items-start z-20 ">
        {/* Left side - Text */}
        <div
          className="space-y-3 text-left flex flex-col items-center md:items-start"
          data-aos="fade-right"
        >
          <img
            src="/illustrasi/budaya/pulau.png"
            alt="Budaya Nusantara Illustration"
            className="w-52 h-auto mb-4 object-contain"
          />
          <h2 className="text-4xl font-extrabold text-white leading-snug">
            Budaya Nusantara
          </h2>
          <p className="text-lg text-white">
            Menjelajahi kekayaan budaya dari pulau-pulau besar di Indonesia.
            Setiap pulau menyimpan cerita unik, tradisi luhur, dan keindahan
            budaya yang patut dijaga.
          </p>
          <a
            href="#"
            className="inline-block z-10 mt-4 px-6 py-3 bg-secondary-300 text-white rounded-xl shadow-md hover:bg-secondary-300/80 transition"
          >
            Jelajahi Semua →
          </a>
        </div>

        {/* Right side - Cards */}
        <div className="grid gap-8 sm:grid-cols-2">
          {islands.map((island, idx) => (
            <TiltCard
              key={idx}
              island={island}
              animation={animations[idx % animations.length]} // pilih animasi sesuai index
            />
          ))}
        </div>
      </div>
    </section>
  );
}
