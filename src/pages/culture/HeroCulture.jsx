import React from "react";

export default function Hero() {
  return (
    <section className="relative w-full min-h-screen flex items-centertext-white overflow-hidden">
      <div
        className="absolute inset-0 bg-[url('/wave/bg.svg')] bg-cover bg-center opacity-10 will-change-transform"
        style={{ backgroundAttachment: "fixed" }}
      />
      {/* Background Decorations */}
      <div className="absolute inset-0">
        <div className="absolute w-72 h-72 rounded-full bg-primary-100 opacity-20 blur-3xl top-20 left-20 animate-pulse" />
        <div className="absolute w-96 h-96 rounded-full bg-primary-100 opacity-20 blur-3xl bottom-20 right-20 animate-bounce" />
      </div>

      {/* Content */}
      <div className="relative z-10 container mx-auto px-6 lg:px-16 flex flex-col-reverse lg:flex-row items-center gap-12">
        {/* Text Content */}
        <div className="flex-1 text-center lg:text-left">
          <h1 className="text-5xl md:text-6xl font-extrabold text-primary-100 leading-tight animate-fade-in-down">
            Budaya Indonesia
            <br />
            <span className="bg-gradient-to-r from-primary-100 via-secondary-300 to-primary-200 bg-clip-text text-transparent">
              Kekayaan Nusantara
            </span>
          </h1>

          <p className="mt-6 text-lg md:text-xl text-primary-100 max-w-lg mx-auto lg:mx-0 animate-fade-in-up">
            Jelajahi ragam{" "}
            <span className="text-secondary-300 font-semibold">tradisi</span>,
            <span className="text-secondary-300 font-semibold"> seni</span>, dan
            <span className="text-secondary-300 font-semibold">
              {" "}
              kearifan lokal
            </span>{" "}
            dari Sabang sampai Merauke. Temukan cerita unik yang membentuk
            identitas bangsa Indonesia.
          </p>

          {/* CTA Buttons */}
          <div className="mt-8 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start animate-fade-in-up animation-delay-700">
            <a href="#pulau" className="px-8 py-3 rounded-2xl font-bold bg-secondary-300 text-white">
              Jelajahi Sekarang
            </a>
          </div>
        </div>

        {/* Illustration / Image */}
        <div className="flex-1 flex justify-center relative animate-float">
          <img
            src="/illustrasi/budaya/hero.png"
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
