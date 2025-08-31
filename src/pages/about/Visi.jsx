import React from "react";

export default function VisiMisi() {
  const misi = [
    "Mengembangkan sumber daya manusia yang kreatif dan kompetitif.",
    "Meningkatkan kolaborasi untuk inovasi dan solusi nyata.",
    "Mendorong kepedulian sosial dan keberlanjutan lingkungan.",
    "Menciptakan platform edukasi dan pengembangan diri.",
  ];

  return (
    <section className="relative bg-primary-100 text-white min-h-screen overflow-hidden">
      <div
        className="absolute inset-0 bg-[url('/wave/bg-about.png')] bg-cover bg-center opacity-10 will-change-transform"
        style={{ backgroundAttachment: "fixed" }}
      />
      <img
        src="/wave/map.png"
        alt="Wave"
        className="hidden md:block w-full h-56 md:h-full object-cover will-change-transform"
      />
      <div className="">
        <h2 className="text-4xl md:text-6xl mb-10 font-bold text-white text-center tracking-tight will-change-transform">
          Jelajahi Kekayaan Budaya Nusantara
        </h2>
        <div className="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center ">
          {/* Visi */}
          <div className="space-y-6 animate-slideInLeft">
            <h2 className="text-4xl font-bold border-l-4 border-secondary-200 pl-4">
              Visi
            </h2>
            <p className="text-lg leading-relaxed text-gray-300">
              Menjadi organisasi yang inovatif, adaptif, dan inspiratif dalam
              membangun generasi yang unggul, kreatif, dan berdampak positif
              bagi masyarakat serta lingkungan sekitar.
            </p>
          </div>

          {/* Misi */}
          <div className="space-y-6 animate-slideInRight">
            <h2 className="text-4xl font-bold border-l-4 border-secondary-200 pl-4">
              Misi
            </h2>
            <div className="grid gap-6 sm:grid-cols-2">
              {misi.map((item, idx) => (
                <div
                  key={idx}
                  className="relative p-6 bg-gray-800/50 rounded-2xl shadow-lg hover:scale-105 transform transition duration-300 border border-gray-700 hover:border-secondary-200"
                >
                  {/* Nomor di kanan atas */}
                  <div className="absolute -top-3 -right-3 w-10 h-10 flex items-center justify-center rounded-full bg-gradient-to-r from-secondary-200 to-secondary-400 text-white font-bold shadow-lg">
                    {idx + 1}
                  </div>
                  <p className="text-gray-200">{item}</p>
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>

      {/* CSS Animasi */}
      <style>{`
        @keyframes slideInLeft {
          0% { opacity: 0; transform: translateX(-50px); }
          100% { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideInRight {
          0% { opacity: 0; transform: translateX(50px); }
          100% { opacity: 1; transform: translateX(0); }
        }
        .animate-slideInLeft {
          animation: slideInLeft 1s ease-out forwards;
        }
        .animate-slideInRight {
          animation: slideInRight 1s ease-out forwards;
        }
      `}</style>
    </section>
  );
}
