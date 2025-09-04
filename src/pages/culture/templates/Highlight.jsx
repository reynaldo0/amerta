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
    <section className="relative w-full py-24 bg-primary-200">
      <div className="max-w-7xl mx-auto px-6 lg:px-16">
        {/* Section Title */}
        <h2 className="text-4xl md:text-5xl font-extrabold text-white text-center mb-12">
          Sorotan Budaya Sumatera
        </h2>

        {/* Highlight Cards */}
        <div className="grid md:grid-cols-3 gap-8">
          {highlights.map((item, idx) => (
            <div
              key={idx}
              className="bg-white/20 backdrop-blur-lg rounded-3xl p-8 flex flex-col items-center text-center shadow-lg hover:shadow-2xl hover:scale-105 transition-transform duration-500 group"
            >
              <div className="w-16 h-16 flex items-center justify-center rounded-full bg-secondary-300 text-white text-2xl mb-4 group-hover:scale-110 transition-transform duration-500">
                <FontAwesomeIcon icon={item.icon} />
              </div>
              <h3 className="text-2xl font-semibold text-white mb-2">
                {item.title}
              </h3>
              <p className="text-white/90">{item.description}</p>
            </div>
          ))}
        </div>
      </div>

      {/* Floating Effects */}
      <div className="absolute top-0 left-0 w-48 h-48 bg-secondary-200 rounded-full opacity-20 blur-3xl animate-pulse-slow"></div>
      <div className="absolute bottom-0 right-0 w-72 h-72 bg-secondary-200 rounded-full opacity-20 blur-3xl animate-bounce-slow"></div>

      <style>{`
        .animate-pulse-slow { animation: pulse 5s ease-in-out infinite; }
        .animate-bounce-slow { animation: bounce 6s infinite; }
      `}</style>
    </section>
  );
}
