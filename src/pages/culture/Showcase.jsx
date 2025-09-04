import React from "react";
import { motion } from "framer-motion";

export default function ProfileCard() {
  return (
    <section className="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary-100 via-primary-200 to-secondary-300 p-6">
      <motion.div
        initial={{ opacity: 0, y: 50 }}
        animate={{ opacity: 1, y: 0 }}
        transition={{ duration: 0.8 }}
        className="max-w-5xl w-full bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl p-8 md:p-12 grid md:grid-cols-2 gap-8 border border-white/20"
      >
        {/* Left Images */}
        <div className="flex flex-col gap-6">
          <motion.img
            whileHover={{ scale: 1.05 }}
            src="/images/monalisa.jpg"
            alt="Mona Lisa"
            className="rounded-2xl shadow-lg object-cover"
          />
          <motion.img
            whileHover={{ scale: 1.05 }}
            src="/images/last-supper.jpg"
            alt="The Last Supper"
            className="rounded-2xl shadow-lg object-cover"
          />
        </div>

        {/* Right Content */}
        <div className="flex flex-col justify-center text-white">
          <motion.h1
            initial={{ x: 50, opacity: 0 }}
            animate={{ x: 0, opacity: 1 }}
            transition={{ delay: 0.2 }}
            className="text-4xl md:text-5xl font-extrabold bg-gradient-to-r from-secondary-200 to-primary-100 bg-clip-text text-transparent"
          >
            Leonardo Da Vinci
          </motion.h1>

          <motion.p
            initial={{ x: 50, opacity: 0 }}
            animate={{ x: 0, opacity: 1 }}
            transition={{ delay: 0.4 }}
            className="mt-4 text-lg leading-relaxed text-gray-100"
          >
            A Renaissance artist, inventor, and scientist who is regarded as one
            of the greatest minds in human history. He was born in Vinci, Italy,
            and was the illegitimate son of a wealthy notary and a peasant
            woman.
          </motion.p>

          {/* Info Section */}
          <div className="mt-6 grid grid-cols-2 gap-6 text-sm">
            <div>
              <p className="text-gray-300">Born</p>
              <p className="font-bold">April 15, 1452</p>
            </div>
            <div>
              <p className="text-gray-300">Died</p>
              <p className="font-bold">May 2, 1519</p>
            </div>
          </div>

          {/* Button */}
          <motion.a
            whileHover={{ scale: 1.05 }}
            href="#paintings"
            className="mt-8 inline-block px-6 py-3 rounded-full font-semibold bg-gradient-to-r from-secondary-200 to-primary-100 text-gray-900 shadow-md hover:shadow-xl transition"
          >
            See Paintings
          </motion.a>
        </div>
      </motion.div>
    </section>
  );
}
