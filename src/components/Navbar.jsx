import React, { useState } from "react";
import { Bars3Icon, XMarkIcon } from "@heroicons/react/24/solid";
import { Link } from "react-router-dom";

const Navbar = () => {
  const [isOpen, setIsOpen] = useState(false);

  const menuItems = [
    { name: "Beranda", path: "/" },
    { name: "Tentang", path: "/tentang" },
    { name: "Budaya", path: "/budaya" },
    { name: "Kuis", path: "/kuis" },
    { name: "Artikel", path: "/Artikel" },
    { name: "Komunitas", path: "/komunitas" },
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
          {menuItems.map((item) => (
            <li key={item.name}>
              <Link
                to={item.path}
                className="relative transition duration-300 hover:text-secondary-300 
                  after:content-[''] after:absolute after:left-0 after:-bottom-1 
                  after:h-[2px] after:w-0 after:bg-secondary-300 after:transition-all 
                  after:duration-300 hover:after:w-full"
              >
                {item.name}
              </Link>
            </li>
          ))}
        </ul>

        {/* Tombol Dashboard Desktop */}
        <Link
          to="/dashboard"
          className="hidden md:inline bg-secondary-300 hover:bg-secondary-300/80 text-white font-bold 
            px-5 py-2 rounded-full transition duration-300 shadow-md"
        >
          Buat Akun
        </Link>

        {/* Hamburger Button (Mobile) */}
        <button
          onClick={() => setIsOpen(!isOpen)}
          className="md:hidden w-8 h-8 flex items-center justify-center text-gray-900 focus:outline-none"
        >
          {isOpen ? (
            <XMarkIcon className="h-7 w-7 text-secondary-300 transition duration-300" />
          ) : (
            <Bars3Icon className="h-7 w-7 text-secondary-300 transition duration-300" />
          )}
        </button>
      </div>

      {/* Mobile Menu */}
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
        {menuItems.map((item) => (
          <Link
            key={item.name}
            to={item.path}
            onClick={() => setIsOpen(false)}
            className="text-gray-900 font-medium hover:text-secondary-300 transition"
          >
            {item.name}
          </Link>
        ))}

        {/* Tombol Dashboard (Mobile) */}
        <Link
          to="/dashboard"
          onClick={() => setIsOpen(false)}
          className="bg-[#594537] hover:bg-[#6e3717] text-white font-bold 
            px-5 py-2 rounded-full transition duration-300 shadow-md"
        >
          Buat Akun
        </Link>
      </div>
    </nav>
  );
};

export default Navbar;
