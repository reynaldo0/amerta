import React from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
  faUtensils,
  faGamepad,
  faMusic,
} from "@fortawesome/free-solid-svg-icons";

const highlights = [
  {
    icon: faUtensils,
    title: "Budaya Keseharian",
    description:
      "Menampilkan kehidupan sehari-hari masyarakat Sumatera, termasuk adat makan, ritual, dan kebiasaan tradisional.",
  },
  {
    icon: faGamepad,
    title: "Budaya Permainan",
    description:
      "Permainan tradisional yang dimainkan sejak zaman dahulu, termasuk permainan anak-anak dan permainan komunitas.",
  },
  {
    icon: faMusic,
    title: "Budaya Tarian",
    description:
      "Tarian tradisional Sumatera yang indah, menggambarkan cerita rakyat, perayaan, dan simbolisme budaya.",
  },
];

export default function Highlight() {
  return (
    <section className="relative w-full py-24 min-h-screen flex items-center justify-center overflow-hidden bg-primary-200">
      <div
        className="absolute inset-0 bg-[url('/wave/budaya.png')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />
      <div className="absolute bottom-0 w-full overflow-hidden leading-[0] z-20 will-change-transform">
        <img
          src="/wave/budayaC.png"
          alt="Wave"
          className="w-full h-full object-cover will-change-transform"
        />
      </div>
      <div className="max-w-7xl mx-auto px-6 lg:px-16 z-10 pb-20">
        {/* Section Title */}
        <h2 className="text-4xl md:text-5xl font-extrabold text-white text-center mb-16 drop-shadow-lg">
          Budaya Khas Pulau Jawa
        </h2>

        {/* Highlight Cards */}
        <div className="grid md:grid-cols-3 gap-10">
          {highlights.map((item, idx) => (
            <div
              key={idx}
              className="relative bg-white/10 backdrop-blur-xl rounded-3xl p-10 flex flex-col items-center text-center shadow-xl transform transition-all duration-500 hover:scale-110 hover:-rotate-2 group"
            >
              {/* Gradient Icon Circle */}
              <div className="relative w-20 h-20 flex items-center justify-center rounded-full bg-gradient-to-r from-secondary-200 to-secondary-300 text-white text-3xl mb-6 shadow-lg group-hover:shadow-secondary-200/60 transition-all duration-500">
                <FontAwesomeIcon icon={item.icon} />
                <div className="absolute inset-0 rounded-full bg-white/30 blur-xl opacity-0 group-hover:opacity-80 transition-opacity duration-500"></div>
              </div>

              <h3 className="text-2xl font-bold text-white mb-3 group-hover:text-secondary-200 transition-colors duration-300">
                {item.title}
              </h3>
              <p className="text-white/80 leading-relaxed">
                {item.description}
              </p>
            </div>
          ))}
        </div>
      </div>

      {/* Animations */}
      <style>{`
        .animate-pulse-slow { animation: pulse 6s ease-in-out infinite; }
        .animate-bounce-slow { animation: bounce 8s infinite; }
      `}</style>
    </section>
  );
}
