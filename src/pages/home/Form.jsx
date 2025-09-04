import React, { useState, useEffect, useRef } from "react";
import Typed from "typed.js";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
  faUser,
  faEnvelope,
  faMapMarkerAlt,
  faCloudUploadAlt,
} from "@fortawesome/free-solid-svg-icons";

const Form = () => {
  const [previewImage, setPreviewImage] = useState(null);
  const typedRef = useRef(null); // Ref for typed.js

  useEffect(() => {
    if (typedRef.current) {
      const typed = new Typed(typedRef.current, {
        strings: ["Nusantara", "Indonesia", "Budaya"],
        typeSpeed: 60,
        backSpeed: 30,
        backDelay: 2000,
        loop: true,
      });

      return () => typed.destroy();
    }
  }, []);

  const handleFileUpload = (event) => {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onloadend = () => {
      setPreviewImage(reader.result);
    };
    reader.readAsDataURL(file);
  };

  return (
    <section className="bg-white relative min-h-screen py-24 flex lg:pb-40">
      {/* Background Parallax */}
      <div
        className="absolute inset-0 bg-[url('/wave/bg.svg')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />

      <div className="absolute top-0 w-full overflow-hidden leading-[0] z-20 will-change-transform">
        <img
          src="/wave/coklatA.png"
          alt="Wave"
          className="w-full h-full object-cover will-change-transform"
        />
      </div>

      <div className="flex flex-col-reverse xl:flex-row xl:gap-20 items-center justify-between px-8 md:px-24 xl:px-20 z-10">
        {/* Form Section */}
        <div className="space-y-6 flex-1 pt-16 xl:pt-0">
          <div className="px-4 py-3">
            <h1 className="font-bold text-3xl">
              Dari kamu untuk
              <span
                ref={typedRef}
                className="text-white bg-secondary-300 mx-1 lg:px-2"
              ></span>
            </h1>
            <p className="pt-2 text-base text-justify">
              Ingin warisan budaya Indonesia terus lestari? Isi formulir ini
              untuk berbagi cerita dan ide-idemu. Bersama, kita jaga kekayaan
              budaya Nusantara.
            </p>
          </div>

          {/* Nama Lengkap */}
          <div className="flex items-center border border-gray-300 rounded-full px-4 py-3 bg-white shadow-lg">
            <input
              id="nama"
              type="text"
              placeholder="Nama Lengkap"
              className="flex-grow focus:outline-none text-gray-600"
            />
            <FontAwesomeIcon icon={faUser} className="text-gray-400" />
          </div>

          {/* Email dan Asal Daerah */}
          <div className="flex flex-wrap gap-4">
            <div className="flex items-center border border-gray-300 rounded-full px-4 py-3 bg-white shadow-lg flex-1">
              <input
                id="email"
                type="email"
                placeholder="Email Aktif"
                className="flex-grow focus:outline-none text-gray-600"
              />
              <FontAwesomeIcon icon={faEnvelope} className="text-gray-400" />
            </div>
            <div className="flex items-center border border-gray-300 rounded-full px-4 py-3 bg-white shadow-lg flex-1">
              <input
                id="asal"
                type="text"
                placeholder="Asal Daerah"
                className="flex-grow focus:outline-none text-gray-600"
              />
              <FontAwesomeIcon
                icon={faMapMarkerAlt}
                className="text-gray-400"
              />
            </div>
          </div>

          {/* Fitur */}
          <textarea
            id="fitur"
            placeholder="Apa fitur yang menurut Anda perlu ditambahkan ke dalam website ini untuk memperkenalkan budaya Nusantara dengan lebih baik?"
            className="w-full border border-gray-300 rounded-2xl px-4 py-3 bg-white focus:outline-none resize-none text-gray-600 shadow-lg"
            rows="4"
          ></textarea>

          {/* Upload Section */}
          <div className="flex gap-4 items-start">
            {/* Preview Area */}
            <div
              id="preview"
              className="flex items-center h-40 md:h-36 justify-center border border-gray-300 rounded-2xl bg-white shadow-lg flex-[1]"
            >
              {previewImage ? (
                <img
                  src={previewImage}
                  alt="Preview"
                  className="object-contain w-full h-full rounded-2xl"
                />
              ) : (
                <div className="w-full h-40 md:h-36 flex items-center justify-center rounded-2xl bg-gray-100 text-gray-400">
                  <span className="text-sm">No file</span>
                </div>
              )}
            </div>

            {/* Upload Area */}
            <label
              htmlFor="fileUpload"
              className="cursor-pointer border-2 border-dashed border-gray-300 rounded-2xl bg-transparent flex flex-col items-center justify-center p-6 flex-[2]"
            >
              <div className="text-center">
                <FontAwesomeIcon
                  icon={faCloudUploadAlt}
                  className="text-4xl text-gray-400 mb-2"
                />

                <p className="text-gray-600">
                  <span className="underline">Click to upload</span> or drag and
                  drop
                </p>
                <p className="text-sm text-gray-400">
                  Only PNG, JPG, JPEG files are supported
                </p>
              </div>
              <input
                id="fileUpload"
                type="file"
                accept=".png,.jpg,.jpeg"
                className="hidden"
                onChange={handleFileUpload}
              />
            </label>
          </div>

          {/* Pengalaman */}
          <textarea
            id="pengalaman"
            placeholder="Jika Anda memiliki pengalaman yang relevan, silakan ceritakan kepada tim kami."
            className="w-full border border-gray-300 rounded-2xl px-4 py-3 bg-white focus:outline-none resize-none text-gray-600 shadow-lg"
            rows="4"
          ></textarea>

          {/* Submit Button */}
          <button
            type="submit"
            className="w-full bg-secondary-300 text-white font-semibold py-3 rounded-full hover:bg-secondary-300/90 transition"
          >
            Kirim
          </button>
        </div>

        {/* Illustration Section */}
        <div className="flex justify-center items-center relative">
          <div className="relative rounded-full w-full flex justify-center items-center">
            <img
              src="/illustrasi/form.png"
              draggable="false"
              alt="Tari Nusantara"
              className="w-80 md:w-[600px] h-auto object-contain animate-float hover:scale-105 transition-transform duration-300 hover:rotate-10 hover:translate-y-1"
            /> 
          </div>
          <div className="absolute top-4 left-4">
            <div className="w-6 h-6 border-[2px] border-gray-400 rounded-full"></div>
            <div className="w-4 h-4 border-[2px] border-gray-400 rounded-full mt-10"></div>
          </div>
          <div className="absolute bottom-4 right-4">
            <div className="w-4 h-4 border-[2px] border-gray-400 rounded-full mb-10"></div>
            <div className="w-6 h-6 border-[2px] border-gray-400 rounded-full"></div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Form;
