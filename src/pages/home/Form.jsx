import React, { useState, useEffect, useRef } from "react";
import Typed from "typed.js";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
  faUser,
  faEnvelope,
  faMapMarkerAlt,
  faCloudUploadAlt,
  faCheckCircle,
} from "@fortawesome/free-solid-svg-icons";
import axios from "axios";

const Form = () => {
  const [previewImage, setPreviewImage] = useState(null);
  const [modalOpen, setModalOpen] = useState(false);
  const [submitting, setSubmitting] = useState(false);
  const typedRef = useRef(null);

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
    reader.onloadend = () => setPreviewImage(reader.result);
    reader.readAsDataURL(file);
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setSubmitting(true);

    const formData = new FormData();
    formData.append("name", e.target.nama.value);
    formData.append("email", e.target.email.value);
    formData.append("address", e.target.asal.value);
    formData.append("description", e.target.fitur.value);
    formData.append("story", e.target.pengalaman.value);
    if (e.target.fileUpload.files[0]) {
      formData.append("media", e.target.fileUpload.files[0]);
    }

    try {
      await axios.post("http://localhost:8000/api/v1/mail", formData, {
        headers: { "Content-Type": "multipart/form-data" },
      });
      setModalOpen(true); // buka modal sukses
      e.target.reset();
      setPreviewImage(null);
    } catch (err) {
      console.error("Gagal mengirim:", err);
      alert("Gagal mengirim. Silakan coba lagi!");
    } finally {
      setSubmitting(false);
    }
  };

  return (
    <section className="bg-white relative min-h-screen py-24 flex lg:pb-40">
      <div
        className="absolute inset-0 bg-[url('/wave/bg.svg')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />
      <form
        onSubmit={handleSubmit}
        className="flex flex-col-reverse xl:flex-row xl:gap-20 items-center justify-between px-8 md:px-24 xl:px-20 z-10 w-full"
      >
        {/* Form Inputs */}
        <div className="space-y-6 flex-1 pt-16 xl:pt-0">
          <h1 className="font-bold text-3xl mb-4">
            Dari kamu untuk
            <span
              ref={typedRef}
              className="text-white bg-secondary-300 mx-1 lg:px-2"
            ></span>
          </h1>

          {/* Nama */}
          <div className="flex items-center border border-gray-300 rounded-full px-4 py-3 bg-white shadow-lg">
            <input
              id="nama"
              name="nama"
              type="text"
              placeholder="Nama Lengkap"
              className="flex-grow focus:outline-none text-gray-600"
              required
            />
            <FontAwesomeIcon icon={faUser} className="text-gray-400" />
          </div>

          {/* Email & Asal */}
          <div className="flex flex-wrap gap-4">
            <div className="flex items-center border border-gray-300 rounded-full px-4 py-3 bg-white shadow-lg flex-1">
              <input
                id="email"
                name="email"
                type="email"
                placeholder="Email Aktif"
                className="flex-grow focus:outline-none text-gray-600"
                required
              />
              <FontAwesomeIcon icon={faEnvelope} className="text-gray-400" />
            </div>
            <div className="flex items-center border border-gray-300 rounded-full px-4 py-3 bg-white shadow-lg flex-1">
              <input
                id="asal"
                name="asal"
                type="text"
                placeholder="Asal Daerah"
                className="flex-grow focus:outline-none text-gray-600"
                required
              />
              <FontAwesomeIcon
                icon={faMapMarkerAlt}
                className="text-gray-400"
              />
            </div>
          </div>

          {/* Description */}
          <textarea
            id="fitur"
            name="fitur"
            placeholder="Apa fitur yang ingin ditambahkan?"
            className="w-full border border-gray-300 rounded-2xl px-4 py-3 bg-white focus:outline-none resize-none text-gray-600 shadow-lg"
            rows="4"
            required
          ></textarea>

          {/* Upload */}
          <div className="flex gap-4 items-start">
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
                  PNG, JPG, JPEG, PDF, DOC, MP4 supported
                </p>
              </div>
              <input
                id="fileUpload"
                name="fileUpload"
                type="file"
                className="hidden"
                onChange={handleFileUpload}
              />
            </label>
          </div>

          {/* Story */}
          <textarea
            id="pengalaman"
            name="pengalaman"
            placeholder="Ceritakan pengalamanmu..."
            className="w-full border border-gray-300 rounded-2xl px-4 py-3 bg-white focus:outline-none resize-none text-gray-600 shadow-lg"
            rows="4"
          ></textarea>

          <button
            type="submit"
            disabled={submitting}
            className="w-full bg-secondary-300 text-white font-semibold py-3 rounded-full hover:bg-secondary-300/90 transition disabled:opacity-50"
          >
            {submitting ? "Mengirim..." : "Kirim"}
          </button>
        </div>

        {/* Illustration */}
        <div className="flex justify-center items-center relative">
          <img
            src="/illustrasi/form.png"
            alt="Tari Nusantara"
            className="w-80 md:w-[600px] h-auto object-contain animate-float hover:scale-105 transition-transform duration-300 hover:rotate-10 hover:translate-y-1"
          />
        </div>
      </form>

      {/* Modal Alert */}
      {modalOpen && (
        <div
          className="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
          onClick={() => setModalOpen(false)} // klik di overlay menutup modal
        >
          <div
            className="bg-white rounded-3xl p-8 max-w-xl w-full text-center relative animate-scale-in"
            onClick={(e) => e.stopPropagation()} // mencegah klik di dalam modal menutup
          >
            <FontAwesomeIcon
              icon={faCheckCircle}
              className="text-green-500 text-5xl mx-auto mb-4 animate-bounce"
            />
            <h2 className="text-2xl font-bold mb-2">Pesan Terkirim!</h2>
            <p className="text-gray-600 mb-6">
              Terima kasih sudah berbagi cerita dan ide. Tim kami akan segera
              meninjau.
            </p>
            <button
              onClick={() => setModalOpen(false)}
              className="bg-secondary-300 text-white px-6 py-2 rounded-full font-semibold hover:bg-secondary-400 transition"
            >
              Tutup
            </button>
          </div>

          {/* Animation */}
          <style>{`
      @keyframes scaleIn {
        0% {transform: scale(0.5); opacity:0;}
        100% {transform: scale(1); opacity:1;}
      }
      .animate-scale-in {animation: scaleIn 0.5s ease-out forwards;}
    `}</style>
        </div>
      )}
    </section>
  );
};

export default Form;
