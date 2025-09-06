import React from "react";

export default function VisiMisi() {
  const misi = [
    "Melestarikan dan mempromosikan kekayaan budaya lokal melalui edukasi dan kegiatan kreatif.",
    "Mendorong kolaborasi antar komunitas untuk inovasi budaya dan solusi kreatif.",
    "Meningkatkan kesadaran sosial dan keberlanjutan melalui praktik budaya yang bertanggung jawab.",
    "Menyediakan platform edukasi dan pengembangan diri berbasis budaya untuk generasi muda.",
    "Mendorong partisipasi aktif masyarakat dalam menjaga dan mengembangkan tradisi budaya.",
    "Mengintegrasikan teknologi dengan budaya untuk menciptakan pengalaman belajar yang interaktif dan menarik.",
  ];

  return (
    <section className="relative bg-primary-100 text-white min-h-screen overflow-hidden">
      {/* Background Parallax */}
      <img
        src="/wave/map2.png"
        alt="Wave"
        className="hidden md:block w-full h-full object-cover will-change-transform"
      />
      <div
        className="absolute inset-0 bg-[url('/wave/aboutw.png')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />
      <h2 className="text-2xl md:text-5xl mb-10 font-bold text-white text-center tracking-tight will-change-transform">
        Jelajahi Kekayaan Budaya Nusantara
      </h2>
      <div className="py-24">
        <div className="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center ">
          {/* Visi */}
          <div className="space-y-6 animate-slideInLeft">
            <h2 className="text-4xl font-bold border-l-4 border-secondary-200 pl-4">
              Visi
            </h2>
            <p className="text-lg leading-relaxed text-gray-300">
              Menjadi pusat inspirasi dan edukasi budaya, yang memberdayakan
              masyarakat untuk melestarikan dan mengembangkan warisan budaya
              Indonesia secara kreatif dan inovatif
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
                  className="relative p-6 rounded-2xl shadow-lg hover:scale-105 transform transition duration-300 
             border border-gray-700 hover:border-secondary-200 
             bg-secondary-300/40 backdrop-blur-lg"
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
