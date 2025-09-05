import React from "react";

export default function HeroSumateraStacked() {
  return (
    <section className="relative w-full min-h-screen overflow-hidden bg-white">
      {/* Background */}
      <img
        src="/wave/budayaB.png"
        alt="Wave"
        className="w-full h-full absolute bottom-0 "
      />
      <div
        className="absolute inset-0 bg-[url('/wave/budaya.png')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />
      {/* Floating shapes */}
      <div className="absolute w-60 h-60 rounded-full bg-secondary-300 opacity-20 blur-3xl top-10 left-10 animate-pulse-slow"></div>
      <div className="absolute w-80 h-80 rounded-full bg-secondary-300 opacity-20 blur-3xl bottom-10 right-10 animate-bounce-slow"></div>

      <div className="relative py-26 z-10 mx-auto px-6 lg:px-16 flex flex-col-reverse lg:flex-row items-center gap-16">
        {/* Text */}
        <div className="flex-1 lg:order-2 text-center lg:text-left">
          <h1 className="text-4xl md:text-7xl font-serif font-extrabold text-black leading-tight bg-clip-text bg-gradient-to-r from-amber-400 via-yellow-300 to-orange-400 animate-fade-in-down">
            Pulau Jawa
          </h1>
          <p className="mt-6 text-xl md:text-2xl text-black max-w-xl mx-auto lg:mx-0 animate-fade-in-up delay-200">
            Jelajahi <span className="font-semibold">tradisi</span>,{" "}
            <span className="font-semibold">seni</span>, dan{" "}
            <span className="font-semibold">kearifan lokal</span> dari Aceh
            sampai Lampung. Temukan cerita unik yang membentuk identitas budaya
            Sumatera.
          </p>
          <a
            href="#highlights"
            className="mt-8 inline-block px-10 py-4 rounded-3xl bg-secondary-300 backdrop-blur-lg text-white font-semibold  hover:bg-secondary-300/90 transition-transform animate-fade-in-up delay-400"
          >
            Jelajahi Budaya
          </a>
        </div>
        <div className="absolute top-30 right-10 rounded-3xl overflow-hidden transform scale-95 blur-sm opacity-60 transition-all duration-500 hover:translate-x-1 hover:translate-y-1">
          <img
            src="/illustrasi/budaya/peta/jawa.png"
            alt="Budaya Sumatera 1"
            className="w-full h-full object-cover"
          />
        </div>

        {/* Stacked Cards */}
        <div className="flex-1 flex py-24 md:py-0 justify-center lg:justify-end items-center relative w-full h-[36rem] ">
          {/* Back Card */}

          {/* Front Card */}
          <div className="absolute rounded-3xl overflow-hidden shadow-2xl transform transition-transform duration-500 hover:scale-105 hover:-translate-y-3 hover:rotate-1">
            <img
              src="/illustrasi/komunitas.png"
              alt="Budaya Sumatera"
              className="w-full h-full object-cover"
            />
          </div>
        </div>
      </div>

      {/* Animations */}
      <style>{`
        @keyframes fadeInUp {0%{opacity:0;transform:translateY(20px);}100%{opacity:1;transform:translateY(0);}}
        @keyframes fadeInDown {0%{opacity:0;transform:translateY(-20px);}100%{opacity:1;transform:translateY(0);}}
        .animate-fade-in-up {animation: fadeInUp 1s ease-out forwards;}
        .animate-fade-in-down {animation: fadeInDown 1s ease-out forwards;}
        .delay-200 {animation-delay: 0.2s;}
        .delay-400 {animation-delay: 0.4s;}
        .animate-pulse-slow {animation: pulse 4s ease-in-out infinite;}
        .animate-bounce-slow {animation: bounce 4s infinite;}
        .hover\\:glow:hover { box-shadow: 0 0 30px rgba(255,255,255,0.6); }
        .perspective-1000 { perspective: 1000px; }
      `}</style>
    </section>
  );
}
