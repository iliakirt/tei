-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 16 Απρ 2024 στις 19:20:18
-- Έκδοση διακομιστή: 10.4.21-MariaDB
-- Έκδοση PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `newdata`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `company`
--

CREATE TABLE `company` (
  `idc` int(11) NOT NULL,
  `name_company` text NOT NULL,
  `address` text NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `company`
--

INSERT INTO `company` (`idc`, `name_company`, `address`, `phone`, `email`, `password`, `type`);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `diaxeiristes`
--
<!-- $res4=mysqli_query($con,"SELECT email FROM users WHERE unique_id='$u2'");
$mail_user = mysqli_fetch_array($res);


CREATE TABLE `diaxeiristes` (
  `id` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `address` text NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `idc` int(11) NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `diaxeiristes`
--

INSERT INTO `diaxeiristes` (`id`, `fullname`, `address`, `phone`, `email`, `password`, `idc`, `type`);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `errors`
--

CREATE TABLE `errors` (
  `ide` int(11) NOT NULL,
  `error` text NOT NULL,
  `day_error` datetime DEFAULT current_timestamp(),
  `message` text NOT NULL,
  `image` text NOT NULL,
  `material` text NOT NULL,
  `engineer` text NOT NULL,
  `day_service` text NOT NULL,
  `idc` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `errors`
--

INSERT INTO `errors` (`ide`, `error`, `day_error`, `message`, `image`, `material`, `engineer`, `day_service`, `idc`, `id`);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `status`, `id`);
--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`idc`);

--
-- Ευρετήρια για πίνακα `diaxeiristes`
--
ALTER TABLE `diaxeiristes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idc` (`idc`);

--
-- Ευρετήρια για πίνακα `errors`
--
ALTER TABLE `errors`
  ADD PRIMARY KEY (`ide`),
  ADD KEY `idc` (`idc`),
  ADD KEY `id` (`id`);

--
-- Ευρετήρια για πίνακα `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `company`
--
ALTER TABLE `company`
  MODIFY `idc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT για πίνακα `diaxeiristes`
--
ALTER TABLE `diaxeiristes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT για πίνακα `errors`
--
ALTER TABLE `errors`
  MODIFY `ide` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT για πίνακα `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `diaxeiristes`
--
ALTER TABLE `diaxeiristes`
  ADD CONSTRAINT `diaxeiristes_ibfk_1` FOREIGN KEY (`idc`) REFERENCES `company` (`idc`);

--
-- Περιορισμοί για πίνακα `errors`
--
ALTER TABLE `errors`
  ADD CONSTRAINT `errors_ibfk_1` FOREIGN KEY (`idc`) REFERENCES `company` (`idc`),
  ADD CONSTRAINT `errors_ibfk_2` FOREIGN KEY (`id`) REFERENCES `diaxeiristes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
