import React from "react";

export default function Hero() {
  return (
    <section className="relative w-full min-h-screen flex items-center bg-gradient-to-br from-indigo-900 via-purple-900 to-black text-white overflow-hidden">
      {/* Background Decorations */}
      <div className="absolute inset-0">
        <div className="absolute w-72 h-72 rounded-full bg-pink-500 opacity-20 blur-3xl top-20 left-20 animate-pulse" />
        <div className="absolute w-96 h-96 rounded-full bg-indigo-500 opacity-20 blur-3xl bottom-20 right-20 animate-bounce" />
      </div>

      {/* Content */}
      <div className="relative z-10 container mx-auto px-6 lg:px-16 flex flex-col-reverse lg:flex-row items-center gap-12">
        {/* Text Content */}
        <div className="flex-1 text-center lg:text-left">
          <h1 className="text-5xl md:text-6xl font-extrabold leading-tight animate-fade-in-down">
            🚀 Solusi Digital
            <br />
            <span className="bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-400 bg-clip-text text-transparent">
              Modern & Interaktif
            </span>
          </h1>

          <p className="mt-6 text-lg md:text-xl text-gray-300 max-w-lg mx-auto lg:mx-0 animate-fade-in-up">
            Tingkatkan pengalaman digital Anda dengan desain yang{" "}
            <span className="text-pink-400 font-semibold">menarik</span>,
            interaktif, dan pastinya{" "}
            <span className="text-indigo-400 font-semibold">eye-catching</span>.
          </p>

          {/* CTA Buttons */}
          <div className="mt-8 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start animate-fade-in-up animation-delay-700">
            <button className="px-8 py-3 rounded-2xl font-bold bg-gradient-to-r from-pink-500 to-purple-600 hover:shadow-[0_0_25px_rgba(236,72,153,0.9)] transition-all">
              Mulai Sekarang
            </button>
            <button className="px-8 py-3 rounded-2xl font-bold border border-gray-400 hover:bg-white hover:text-black transition-all">
              Lihat Demo
            </button>
          </div>
        </div>

        {/* Illustration / Image */}
        <div className="flex-1 flex justify-center relative animate-float">
          <img
            src="/illustrasi/wayang.png"
            alt="Hero Illustration"
            className="w-72 md:w-96 drop-shadow-2xl hover:scale-105 transition-transform duration-500"
          />
        </div>
      </div>

      {/* Custom Animations */}
      <style>{`
        @keyframes fadeInDown {
          0% { opacity: 0; transform: translateY(-40px); }
          100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInUp {
          0% { opacity: 0; transform: translateY(40px); }
          100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
          0% { transform: translateY(0); }
          50% { transform: translateY(-20px); }
          100% { transform: translateY(0); }
        }
        .animate-fade-in-down { animation: fadeInDown 1s ease-out forwards; }
        .animate-fade-in-up { animation: fadeInUp 1s ease-out forwards; }
        .animate-float { animation: float 5s ease-in-out infinite; }
        .animation-delay-700 { animation-delay: 0.7s; }
      `}</style>
    </section>
  );
}
