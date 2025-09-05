import React from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
  faLandmark,
  faPeopleGroup,
  faBookOpen,
} from "@fortawesome/free-solid-svg-icons";

export default function BudayaSection() {
  return (
    <section className="w-full bg-white py-20 md:py-24 px-6 md:px-16">
      <div
        className="absolute inset-0 bg-[url('/wave/budaya.png')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />
      <div className="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center relative">
        {/* Left: Image */}
        <div className="relative group">
          <img
            src="/illustrasi/artikel.png"
            alt="Wayang"
            className="rounded-3xl  transform group-hover:scale-105 transition duration-500"
          />
          <div className="absolute -bottom-6 -right-6 bg-secondary-300 text-white px-4 py-2 rounded-full shadow-lg text-sm font-semibold">
            Budaya Nusantara
          </div>
        </div>

        {/* Right: Content */}
        <div>
          <p className="text-secondary-200 font-semibold mb-2">
            — Artikel Budaya
          </p>
          <h2 className="text-4xl md:text-5xl font-bold mb-6 leading-tight">
            Warisan <span className="text-secondary-300">Budaya</span> Indonesia
          </h2>
          <p className="text-gray-600 mb-6 leading-relaxed">
            Indonesia memiliki keragaman budaya yang luar biasa, mulai dari
            tarian tradisional, seni musik, hingga warisan tak benda yang diakui
            dunia. Setiap daerah memiliki keunikan tersendiri yang memperkaya
            identitas bangsa.
          </p>

          {/* Highlight Features */}
          <div className="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
            <div className="flex items-start gap-4">
              <FontAwesomeIcon
                icon={faLandmark}
                className="text-secondary-300 text-2xl"
              />
              <div>
                <h3 className="font-semibold text-lg">Warisan Sejarah</h3>
                <p className="text-sm text-gray-600">
                  Situs dan tradisi yang telah menjadi bagian penting dari
                  perjalanan bangsa.
                </p>
              </div>
            </div>
            <div className="flex items-start gap-4">
              <FontAwesomeIcon
                icon={faPeopleGroup}
                className="text-secondary-300 text-2xl"
              />
              <div>
                <h3 className="font-semibold text-lg">Ragam Tradisi</h3>
                <p className="text-sm text-gray-600">
                  Upacara adat dan festival budaya yang memperkuat persatuan
                  masyarakat.
                </p>
              </div>
            </div>
            <div className="flex items-start gap-4">
              <FontAwesomeIcon
                icon={faBookOpen}
                className="text-secondary-300 text-2xl"
              />
              <div>
                <h3 className="font-semibold text-lg">Cerita & Sastra</h3>
                <p className="text-sm text-gray-600">
                  Karya sastra, legenda, dan cerita rakyat yang diwariskan
                  lintas generasi.
                </p>
              </div>
            </div>
          </div>

          {/* Button */}
          <button className="bg-secondary-300 cursor-pointer text-white px-6 py-3 rounded-full font-semibold hover:bg-secondary-300/90 transition">
            Baca Selengkapnya
          </button>
        </div>
      </div>
    </section>
  );
}
