import React from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faArrowRight } from "@fortawesome/free-solid-svg-icons";
import { Link } from "react-router-dom"; // kalau pakai React Router

const articles = [
  {
    id: 1,
    title: "Jejak Budaya Nusantara yang Tak Ternilai",
    image: "/illustrasi/budaya/wayang.jpg",
    excerpt:
      "Indonesia dikenal sebagai negara kepulauan terbesar di dunia, dengan ribuan pulau dan ragam budaya yang diwariskan turun-temurun...",
    category: "Budaya",
  },
  {
    id: 2,
    title: "Batik: Warisan Tak Benda Dunia",
    image: "/illustrasi/budaya/batik.jpg",
    excerpt:
      "Batik Indonesia telah mendapat pengakuan dunia dari UNESCO, menjadi identitas bangsa sekaligus karya seni bernilai tinggi...",
    category: "Seni",
  },
  {
    id: 3,
    title: "Angklung dan Gamelan: Musik Tradisi yang Mendunia",
    image: "/illustrasi/budaya/gamelan.jpg",
    excerpt:
      "Alunan musik tradisional seperti angklung dan gamelan membawa harmoni yang tidak hanya dikenal di Indonesia tetapi juga di mancanegara...",
    category: "Musik",
  },
];

export default function Articles() {
  return (
    <section className="w-full bg-white relative py-20 px-6 md:px-12">
      <div
        className="absolute inset-0 bg-[url('/wave/budaya.png')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />
      <div className="max-w-7xl mx-auto relative">
        <h2 className="text-3xl md:text-4xl font-bold text-center mb-12">
          Artikel Budaya
        </h2>

        <div className="grid gap-10 md:grid-cols-3 relative">
          {articles.map((article) => (
            <div
              key={article.id}
              className="group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden flex flex-col"
            >
              {/* Image */}
              <div className="relative w-full h-56 overflow-hidden">
                <img
                  src={article.image}
                  alt={article.title}
                  className="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                />
                {/* Gradient overlay */}
                <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                {/* Badge */}
                <span className="absolute top-4 left-4 bg-secondary-300 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-md">
                  {article.category}
                </span>
              </div>

              {/* Content */}
              <div className="p-6 flex flex-col flex-grow">
                <h3 className="text-xl font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-secondary-300 transition">
                  {article.title}
                </h3>
                <p className="text-gray-600 mb-4 flex-grow line-clamp-3">
                  {article.excerpt}
                </p>

                {/* Button */}
                <Link
                  to={`/artikel/${article.id}`}
                  className="mt-auto inline-flex items-center justify-center gap-2 px-5 py-2 rounded-full bg-secondary-300 text-white font-medium hover:bg-secondary-400 shadow-md hover:shadow-lg transition-all"
                >
                  Baca Selengkapnya
                  <FontAwesomeIcon icon={faArrowRight} className="w-4 h-4" />
                </Link>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
