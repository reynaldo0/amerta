import { BrowserRouter, Route, Routes } from "react-router-dom";
import Navbar from "./components/Navbar";
import FeaturesSection from "./pages/home/Feature";
import Peta from "./pages/home/Peta";
import Home from "./pages/Home";
import About from "./pages/About";
import Quiz from "./pages/quiz/question";

function App() {
  return (
    <BrowserRouter>
      <Navbar />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/beranda" element={<Home />} />
        <Route path="/tentang" element={<About />} />
        <Route path="/kuis" element={<Quiz />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;
