import React from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faMapMarkerAlt, faEnvelope } from "@fortawesome/free-solid-svg-icons";

const Footer = () => {
  return (
    <footer className="bg-primary-200 relative">
      <div className="absolute top-0 w-full overflow-hidden leading-[0] will-change-transform">
        <img
          src="/wave/map2.png"
          alt="Wave"
          className="w-full h-full object-cover will-change-transform"
        />
      </div>
      <div
        className="absolute inset-0 bg-[url('/wave/budaya.png')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />
      <div className="container mx-auto w-full p-4 py-6 md:py-8 md:pt-32 relative md:px-10">
        <div className="md:flex md:justify-between">
          <div className="mb-6 flex flex-col justify-between md:mb-0">
            <a href="#home" className="flex items-center">
              <img
                src="/logo.png"
                className="me-3 h-auto w-[50px] md:w-[60px]"
                alt="FlowBite Logo"
              />
              <p className="text-2xl md:text-3xl tracking-wider text-white font-bold">
                Amerta
              </p>
            </a>

            <div className="mb-5 mt-10 md:mb-0">
              <h2 className="mb-6 text-base font-semibold uppercase text-white">
                Hubungi Kami
              </h2>
              <ul className="font-medium text-gray-300/90">
                <li className="mb-4 flex items-center gap-3 text-base">
                  <FontAwesomeIcon
                    icon={faMapMarkerAlt}
                    className="w-5 h-5 text-gray-300/90"
                  />
                  <a href="#" className="hover:underline">
                    Universitas Negeri Jakarta
                  </a>
                </li>
                <li className="mb-4 flex items-center gap-3 text-base">
                  <FontAwesomeIcon
                    icon={faEnvelope}
                    className="w-5 h-5 text-gray-300/90"
                  />
                  <a
                    href="mailto:amerta@gmail.com?subject=Hallo Amerta! Saya ingin mengajak anda untuk berkolaborasi..."
                    className="hover:underline"
                  >
                    amerta@gmail.com
                  </a>
                </li>
              </ul>
            </div>
          </div>

          <div className="grid grid-cols-2 md:grid-cols-3 gap-8 sm:gap-8 md:gap-10 lg:gap-28">
            <div>
              <h2 className="mb-6 text-sm font-semibold uppercase text-white">
                Akses Konten
              </h2>
              <ul className="font-medium text-gray-300/90">
                <li className="mb-4">
                  <a href="/" className="hover:underline">
                    Beranda
                  </a>
                </li>
                <li className="mb-4">
                  <a href="/about" className="hover:underline">
                    Tentang
                  </a>
                </li>
                <li className="mb-4">
                  <a href="/budaya" className="hover:underline">
                    budaya
                  </a>
                </li>
                <li className="mb-4">
                  <a href="/artikel" className="hover:underline">
                    Artikel
                  </a>
                </li>
                <li className="mb-4">
                  <a href="/komunitas" className="hover:underline">
                    komunitas
                  </a>
                </li>
              </ul>
            </div>

            <div>
              <h2 className="mb-6 text-sm font-semibold uppercase text-white">
                Sumber Data
              </h2>
              <ul className="font-medium text-gray-300/90">
                <li className="mb-4">
                  <a
                    href="https://www.omahbse.com"
                    className="lowercase hover:underline"
                  >
                    Omahbse.com
                  </a>
                </li>
                <li className="mb-4">
                  <a
                    href="https://culture-indonesia-ku.blogspot.com"
                    className="lowercase hover:underline"
                  >
                    Culture-indonesia-ku
                  </a>
                </li>

                <li className="mb-4">
                  <a
                    href="https://indonesiakaya.com/"
                    className="lowercase hover:underline"
                  >
                    Indonesiakaya
                  </a>
                </li>
                <li className="mb-4">
                  <a
                    href="https://kemendikdasmen.go.id/"
                    className="lowercase hover:underline"
                  >
                    Kemendikbud
                  </a>
                </li>
              </ul>
            </div>

            <div>
              <h2 className="mb-6 text-sm font-semibold uppercase text-white">
                Credit
              </h2>
              <ul className="font-medium text-gray-300/90">
                <li className="mb-4">
                  <a href="https://www.canva.com/" className="hover:underline">
                    Canva
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <hr className="my-6 border-white sm:mx-auto lg:my-8" />
        <div className="sm:flex sm:items-center sm:justify-between">
          <span className="text-center text-sm text-gray-300/90">
            Dibuat oleh Tim Amerta
          </span>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
