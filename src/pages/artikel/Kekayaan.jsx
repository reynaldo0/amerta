import React, { useEffect } from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
  faQuoteLeft,
  faGlobe,
  faHandsHelping,
} from "@fortawesome/free-solid-svg-icons";
import AOS from "aos";
import "aos/dist/aos.css";

export default function Kekayaan() {
  useEffect(() => {
    AOS.init({
      duration: 1000,
      once: true,
    });
  }, []);

  return (
    <section className="w-full bg-white py-20 relative px-6 md:px-16 overflow-hidden" id="kekayaan">
      {/* Background */}
      <div
        className="absolute inset-0 bg-[url('/wave/budaya.png')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />

      <div className="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center relative">
        {/* Left Content */}
        <div data-aos="fade-right">
          <p className="text-secondary-300 font-semibold uppercase mb-3">
            — Artikel Budaya
          </p>
          <h2 className="text-4xl md:text-5xl font-bold mb-6 leading-tight">
            Mengenal Lebih Dalam <br />
            <span className="text-secondary-300">Kekayaan Nusantara</span>
          </h2>
          <p className="text-gray-600 mb-6 leading-relaxed">
            Indonesia adalah negeri dengan keberagaman budaya yang luar biasa.
            Dari Sabang sampai Merauke, setiap daerah memiliki ciri khas dalam
            tradisi, seni, dan adat istiadatnya. Inilah yang menjadikan bangsa
            kita begitu kaya dan unik di mata dunia.
          </p>

          {/* Highlight points */}
          <div className="grid sm:grid-cols-2 gap-6 mb-8">
            <div className="flex items-start gap-4" data-aos="zoom-in-up">
              <FontAwesomeIcon
                icon={faGlobe}
                className="text-secondary-300 text-2xl"
              />
              <div>
                <h3 className="font-semibold text-lg">Keragaman Global</h3>
                <p className="text-sm text-gray-600">
                  Budaya Indonesia diakui dunia melalui UNESCO dan berbagai
                  festival internasional.
                </p>
              </div>
            </div>
            <div
              className="flex items-start gap-4"
              data-aos="zoom-in-up"
              data-aos-delay="200"
            >
              <FontAwesomeIcon
                icon={faHandsHelping}
                className="text-secondary-300 text-2xl"
              />
              <div>
                <h3 className="font-semibold text-lg">Kebersamaan</h3>
                <p className="text-sm text-gray-600">
                  Gotong royong sebagai nilai luhur yang menjaga persatuan
                  bangsa.
                </p>
              </div>
            </div>
          </div>

          {/* CTA Button */}
          <a href="#article"
            className="bg-secondary-300 cursor-pointer text-white px-6 py-3 rounded-full font-semibold hover:scale-105 transition duration-300"
            data-aos="fade-up"
          >
            Jelajahi Artikel
          </a>
        </div>

        {/* Right Image + Quote */}
        <div className="relative" data-aos="fade-left">
          <img
            src="/illustrasi/komunitas.png"
            alt="Budaya Indonesia"
            className="rounded-3xl shadow-xl transform hover:scale-105 transition duration-500"
          />
          <div
            className="absolute -bottom-10 left-6 bg-white rounded-2xl shadow-lg p-6 w-[80%]"
            data-aos="zoom-in-up"
            data-aos-delay="300"
          >
            <FontAwesomeIcon
              icon={faQuoteLeft}
              className="text-secondary-300 text-2xl mb-2"
            />
            <p className="text-gray-700 italic">
              "Budaya adalah identitas yang menyatukan bangsa dan menghubungkan
              generasi."
            </p>
          </div>
        </div>
      </div>
    </section>
  );
}
