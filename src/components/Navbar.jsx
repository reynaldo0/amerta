import React, { useState } from "react";
import { Bars3Icon, XMarkIcon } from "@heroicons/react/24/solid"; 

const Navbar = () => {
  const [isOpen, setIsOpen] = useState(false);

  const menuItems = [
    "Beranda",
    "Tentang",
    "Budaya",
    "Kuis",
    "Konsultasi",
    "FAQ",
  ];

  return (
    <nav className="fixed top-4 left-1/2 -translate-x-1/2 z-50 w-[90%] md:w-[80%]">
      <div
        className="flex items-center justify-between 
        bg-white/30 backdrop-blur-lg border border-white/20 
        rounded-full shadow-lg px-6 py-3 transition-all duration-300"
      >
        {/* Logo */}
        <div className="flex items-center space-x-2">
          <img src="/logo.png" alt="Logo" className="w-8 h-8 object-contain" />
          <span className="font-bold text-gray-900 drop-shadow-sm">Amerta</span>
        </div>

        {/* Menu Desktop */}
        <ul className="hidden md:flex space-x-6 text-gray-900 font-medium">
          {menuItems.map((item) => {
            const id = item.toLowerCase().replace(/\s+/g, "-"); // spasi → dash
            return (
              <li key={item}>
                <a
                  href={`${id}`}
                  className="relative transition duration-300 hover:text-[#84441E] 
                  after:content-[''] after:absolute after:left-0 after:-bottom-1 
                  after:h-[2px] after:w-0 after:bg-[#84441E] after:transition-all 
                  after:duration-300 hover:after:w-full"
                >
                  {item}
                </a>
              </li>
            );
          })}
        </ul>

        {/* Tombol Dashboard Desktop */}
        <a
          href="#dashboard"
          className="hidden md:inline bg-[#84441E] hover:bg-[#6e3717] text-white font-bold 
            px-5 py-2 rounded-full transition duration-300 shadow-md"
        >
          Buat Akun
        </a>

        {/* Hamburger Button (Mobile) pakai Heroicons */}
        <button
          onClick={() => setIsOpen(!isOpen)}
          className="md:hidden w-8 h-8 flex items-center justify-center text-gray-900 focus:outline-none"
        >
          {isOpen ? (
            <XMarkIcon className="h-7 w-7 text-[#84441E] transition duration-300" />
          ) : (
            <Bars3Icon className="h-7 w-7 text-[#84441E] transition duration-300" />
          )}
        </button>
      </div>

      {/* Mobile Menu (kecil di kanan) */}
      <div
        className={`md:hidden fixed top-20 right-4 w-56 bg-white/80 backdrop-blur-md 
        shadow-lg rounded-xl px-6 py-4 flex flex-col items-center space-y-4 
        transition-all duration-300 transform origin-top-right
        ${
          isOpen
            ? "opacity-100 scale-100 translate-y-0"
            : "opacity-0 scale-95 -translate-y-2 pointer-events-none"
        }`}
      >
        {menuItems.map((item) => {
          const id = item.toLowerCase().replace(/\s+/g, "-");
          return (
            <a
              key={item}
              href={`${id}`}
              onClick={() => setIsOpen(false)}
              className="text-gray-900 font-medium hover:text-[#84441E] transition"
            >
              {item}
            </a>
          );
        })}

        {/* Tombol Dashboard (Mobile) */}
        <a
          href="#dashboard"
          onClick={() => setIsOpen(false)}
          className="bg-[#84441E] hover:bg-[#6e3717] text-white font-bold 
            px-5 py-2 rounded-full transition duration-300 shadow-md"
        >
          Buat Akun
        </a>
      </div>
    </nav>
  );
};

export default Navbar;
